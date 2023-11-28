<?php

namespace Veldman\FirebaseCloudMessaging;

class FirebaseMessage
{
    public ?string $title;

    public ?string $body;

    public function title(string $title)
    {
        $this->title = $title;

        return $this;
    }

    public function body(string $body)
    {
        $this->body = $body;

        return $this;
    }

    public function toArray()
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
        ];
    }
}