<?php

declare(strict_types=1);

namespace App\Event;

use ClientEventBundle\Event;
use Symfony\Component\Validator\Constraints as Assert;

class TestEvent extends Event
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=3)
     */
    protected $eventName = 'test';

    protected ?string $field;

    /**
     * @return string|null
     */
    public function getField(): ?string
    {
        return $this->field;
    }

    /**
     * @param string|null $field
     *
     * @return $this
     */
    public function setField(?string $field): self
    {
        $this->field = $field;

        return $this;
    }
}
