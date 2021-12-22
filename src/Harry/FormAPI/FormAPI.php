<?php

namespace Harry\FormAPI;

use pocketmine\form\Form;

use pocketmine\player\Player;

abstract class FormAPI implements Form
{
    public const FORM_TYPE_NORMAL = 0;
    public const FORM_TYPE_CUSTOM = 1;
    public const FORM_TYPE_MODAL = 2;
    
    /** @var array $data */
    protected array $data = [];
    
    /** @var int $formType */
    protected int $formType;
    
    public function __construct(int $type,string $title)
    {
        if($type == 1)
        {
            $formType = 'custom_form';
        }
        elseif($type == 2)
        {
            $formType = 'modal';
        }
        else
        {
            $type = 0;
            $formType = 'form';
        }
        $this->formType = $type;
        $this->data['type'] = $formType;
        $this->data['title'] = $title;
        if($this->getFormType() == 0 OR $this->getFormType() == 2)
        {
            $this->data['content'] = '';
            if($this->getFormType() == 0)
            {
                $this->data['buttons'] = [];
            }
            else
            {
                $this->data['button1'] = '';
                $this->data['button2'] = '';
            }
        }
        if($this->getFormType() == 1)
        {
            $this->data['content'] = [];
        }
    }
    abstract public function setReady(): void;
    abstract public function handleResponse(Player $player,$data): void;
    public function jsonSerialize(): array
    {
        $this->setReady();
        return $this->data;
    }
    public function getFormType(): int
    {
        return $this->formType;
    }
    public function setContent(string $content): void
    {
        if($this->getFormType() == 0 OR $this->getFormType() == 2)
        {
            $this->data['content'] = $content;
        }
    }
    public function addButton(string $text,?int $imageType = null,?string $imagePath = null): void
    {
        $content = ['text' => $text];
        if($this->getFormType() == 0)
        {
            if($imageType !== null)
            {
                $content['image']['type'] = $imageType === 0 ? 'path' : 'url';
                $content['image']['data'] = $imagePath;
            }
            $this->data['buttons'][] = $content;
        }
    }
    public function addLabel(string $text): void
    {
        if($this->getFormType() == 1)
        {
            $this->addContent(['type' => 'label','text' => $text]);
        }
    }
    public function addToggle(string $text,?bool $default = null): void
    {
        if($this->getFormType() == 1)
        {
            $content = ['type' => 'toggle','text' => $text];
            if($default !== null)
            {
                $content['default'] = $default;
            }
            $this->addContent($content);
        }
    }
    public function addSlider(string $text,int $min,int $max,?int $step = null,?int $default = null): void
    {
        if($this->getFormType() == 1)
        {
            $content = ['type' => 'slider','text' => $text,'min' => $min,'max' => $max];
            if($step !== null)
            {
                $content['step'] = $step;
            }
            if($default !== null)
            {
                $content['default'] = $default;
            }
            $this->addContent($content);
        }
    }
    public function addStepSlider(string $text,array $steps,?int $default = null): void
    {
        if($this->getFormType() == 1)
        {
            $content = ['type' => 'step_slider','text' => $text,'steps' => $steps];
            if($default !== null)
            {
                $content['default'] = $default;
            }
            $this->addContent($content);
        }
    }
    public function addDropdown(string $text,array $options,?int $default = null): void
    {
        if($this->getFormType() == 1)
        {
            $content = ['type' => 'dropdown','text' => $text,'options' => $options,];
            if($default !== null)
            {
                $content['default'] = $default;
            }
            $this->addContent($content);
        }
    }
    public function addInput(string $text,?string $placeholder = null,?string $default = null): void
    {
        if($this->getFormType() == 1)
        {
            $content = ['type' => 'input','text' => $text,'placeholder' => $placeholder];
            if($default !== null)
            {
                $content['default'] = $default;
            }
            $this->addContent($content);
        }
    }
    public function addContent(array $content): void
    {
        if($this->getFormType() == 1)
        {
            $this->data['content'][] = $content;
        }
    }
    public function setButton1(string $text): void
    {
        if($this->getFormType() == 2)
        {
            $this->data['button1'] = $text;
        }
    }
    public function setButton2(string $text): void
    {
        if($this->getFormType() == 2)
        {
            $this->data['button2'] = $text;
        }
    }
}