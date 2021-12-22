# FormAPI
[PocketMine-MP 4 Virion] 폼을 더 편하게 만들게 해주는 비리온

## How To Use - 사용법
### Normal Form
```php
class ExampleForm extends Harry\FormAPI\FormAPI
{
    public function __construct()
    {
        parent::__construct(self::FORM_TYPE_NORMAL,'테스트 UI');
    }
    public function setReady() : void
    {
        $this->setContent('테스트 UI입니다.'); // UI안에 텍스트 설정
        $this->addButton('테스트'); // UI 버튼 추가
    }
    public function handleResponse(\pocketmine\player\Player $player,$data) : void { }
}
```
### Custom Form
```php
class ExampleForm extends Harry\FormAPI\FormAPI
{
    public function __construct()
    {
        parent::__construct(self::FORM_TYPE_CUSTOM,'테스트 UI');
    }
    public function setReady() : void
    {
        $this->addLabel('테스트 UI입니다.'); // UI안에 라벨 추가
        $this->addToggle('테스트를 하려면 체크하세요.',false); // UI 토글 추가
        $this->addSlider('플러그인 점수를 매겨주세요.',1,10,1,1); // UI 슬라이더 추가
        $this->addStepSlider('플러그인 점수를 매겨주세요.',['1점','2점','3점'],1); // UI 스텝 슬라이더 추가
        $this->addDropdown('사용할 플러그인을 선택해주세요',['FormAPI','InventoryAPI'],0); // UI 드랍다운 추가
        $this->addInput('플러그인 이름을 입력해주세요.','내용을 입력하세요.','FormAPI'); // UI 인풋 추가
    }
    public function handleResponse(\pocketmine\player\Player $player,$data) : void { }
}
```
### Modal Form
```php
class ExampleForm extends Harry\FormAPI\FormAPI
{
    public function __construct()
    {
        parent::__construct(self::FORM_TYPE_MODAL,'테스트 UI');
    }
    public function setReady() : void
    {
        $this->setContent('테스트 UI입니다.'); // UI안에 텍스트 설정
        $this->setButton1('예'); // true 버튼 설정
        $this->setButton2('아니요'); // false 버튼 설정
    }
    public function handleResponse(\pocketmine\player\Player $player,$data) : void { }
}
```