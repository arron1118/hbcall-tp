<?php
/**
 * copyright@Administrator
 * 2024/3/19 0019 11:56
 * email:arron1118@icloud.com
 */

namespace app\admin\controller;

use app\common\controller\AdminController;
use thiagoalessio\TesseractOCR\TesseractOCR;

class Signature extends AdminController
{
    public function index()
    {
        $imagePath = $this->app->getRootPath() . 'public\static\images\id.jpg';
        dump($imagePath);
        $text = (new TesseractOCR($imagePath))
            ->lang('chi_sim')
            ->run();
        dump($text);
        
        $this->view->assign([
            'image' => $imagePath
        ]);
        return $this->view->fetch();
    }
}
