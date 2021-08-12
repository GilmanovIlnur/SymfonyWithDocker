<?php


namespace App\Controller;


use App\Dto\Request\MessageRequest;
use App\Entity\WallMessage;
use App\Service\WallMessageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

/**\
 * Class WallMessageController
 * @package App\Controller
 * @Route("/wall_message")
 */
class WallMessageController extends AbstractController
{
    private $service;

    public function __construct(WallMessageService $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/message/create", name="message_create", methods={"POST"})
     * @param MessageRequest $request
     * @return RedirectResponse
     */
    public function create(MessageRequest $request)
    {
        $this->service->create($request, $this->getUser());

        return $this->redirectToRoute('profile');
    }

    /**
     * @Route("/message/delete/{id}", name="delete_message", methods={"POST"})
     * @param WallMessage $message
     * @return RedirectResponse
     */
    public function delete(WallMessage $message): RedirectResponse
    {
        $this->service->delete($message);

        return $this->redirectToRoute('profile');
    }

    /**
     * @Route("/message/update/{id}", name="update_message", methods={"POST"})
     * @param WallMessage $message
     * @param MessageRequest $request
     * @return RedirectResponse
     */
    public function update(MessageRequest $request, WallMessage $message): RedirectResponse
    {
        $this->service->update($message, $request);

        return $this->redirectToRoute('profile');
    }
}