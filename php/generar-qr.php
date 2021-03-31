<?php

require_once '../vendor/autoload.php';

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

$link = $_POST['link'] ?? '';

$result = Builder::create()
    ->writer(new PngWriter())
    ->writerOptions([])
    ->data($link)
    ->encoding(new Encoding('UTF-8'))
    ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
    ->size(300)
    ->margin(10)
    ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
    ->labelText('Mi qr')
    ->labelFont(new NotoSans(20))
    ->labelAlignment(new LabelAlignmentCenter())
    ->build();

    header("Content-Type: image/png");
    header('Content-Disposition: attachment;filename="qr.png"');
    header('Cache-Control: max-age=0');

$respuesta  = [
        'op' => 'ok',
        'file' => "data:imagen/png;base64,".base64_encode($result->getString())
];

echo json_encode($respuesta);