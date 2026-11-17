<?php
declare( strict_types = 1 );
namespace App\Controller\Test;

use Hyperf\Contract\TranslatorInterface;
use Hyperf\Di\Annotation\Inject;

enum Test: string {
    case Pending = '1';

}

class Index {

    #[Inject] private TranslatorInterface $translator;

    public function Index() {
        devLog( Test::Pending->value );
    }
}