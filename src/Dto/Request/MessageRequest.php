<?php


namespace App\Dto\Request;


use App\Dto\DtoInterface;
use Symfony\Component\HttpFoundation\Request;

class MessageRequest implements DtoInterface
{
    private $text;

    public function __construct(Request $request)
    {
        $this->text = $request->get('text');
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param $text
     * @return MessageRequest
     */
    public function setText($text): self
    {
        $this->text = $text;

        return $this;
    }
}