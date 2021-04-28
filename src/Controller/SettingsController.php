<?php


namespace App\Controller;


use App\Form\UserInfoType;
use App\Helper\UserInfoHelper;
use App\Service\FileUploadService;
use App\Validator\PasswordChange\PasswordChangeValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\String\Slugger\SluggerInterface;


class SettingsController extends AbstractController
{
    private $changePasswordValidator;

    private $passwordEncoder;

    private $userInfoHelper;

    private $fileUploader;

    public function __construct(
        PasswordChangeValidator $changePasswordValidator,
        UserPasswordEncoderInterface $passwordEncoder,
        UserInfoHelper $userInfoHelper,
        FileUploadService $fileUploader
    )
    {
        $this->changePasswordValidator = $changePasswordValidator;
        $this->passwordEncoder = $passwordEncoder;
        $this->userInfoHelper = $userInfoHelper;
        $this->fileUploader = $fileUploader;
    }

    /**
     * @Route("settings", name="settings")
     */
    public function settings()
    {
        return $this->render('settings.html.twig');
    }

    /**
     * @Route("changePassword", name="changePassword")
     * @return Response
     */
    public function changePassword(Request $request)
    {
        $errors = null;
        if ($request->getMethod() === 'POST') {
            $this->changePasswordValidator->validate($request);
            if (count($this->changePasswordValidator->getErrors()) > 0) {
                $errors = implode(', ', $this->changePasswordValidator->getErrors());
            } else {
                $user = $this->getUser();
                $user->setPassword($this->passwordEncoder->encodePassword($user, $request->get('password1')));
                $this->getDoctrine()->getManager()->persist($user);
                $this->getDoctrine()->getManager()->flush();
            }
        }
        return $this->render('change_password.html.twig', ['errors' => $errors]);
    }

    /**
     * @Route("/edit/userInfo/", name="editUserInfo")
     * @param Request $request
     * @param SluggerInterface $slugger
     * @return Response
     */
    public function editUserInfo(Request $request, SluggerInterface $slugger): Response
    {
        $userInfo = $this->userInfoHelper->findOrCreate($this->getUser()->getId());
        $form = $this->createForm(UserInfoType::class, $userInfo);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($file = $form->get('photoFilename')->getData()) {
                $newFilename = $this->fileUploader->uploadFile($file, $this->getParameter('userPhotosDirectory'));
                $userInfo->setPhotoFilename($newFilename);
                $userInfo->setUser($this->getUser());
                $this->getDoctrine()->getManager()->persist($userInfo);
                $this->getDoctrine()->getManager()->flush();
            }
        }

        return $this->render('edit_user_info.html.twig', [
            'form' => $form->createView()
        ]);
    }
}