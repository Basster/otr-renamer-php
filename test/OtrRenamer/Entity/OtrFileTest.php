<?php

namespace test\OtrRenamer\Entity;


use OtrRenamer\Entity\OtrFile;

class OtrFileTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $filename
     * @param $expect
     * @dataProvider provideSeries
     */
    public function testGetShow($filename, $expect)
    {
        $otrfn = new OtrFile($filename);
        $this->assertEquals($expect['show'], $otrfn->getShow());
    }

    /**
     * @param $filename
     * @param $expect
     * @dataProvider provideSeries
     */
    public function testGetEpDate($filename, $expect)
    {
        $otrfn = new OtrFile($filename);
        $this->assertEquals($expect['ep_date'], $otrfn->getEpDate());
    }

    /**
     * @param $filename
     * @param $expect
     * @dataProvider provideSeries
     */
    public function testGetEpTime($filename, $expect)
    {
        $otrfn = new OtrFile($filename);
        $this->assertEquals($expect['ep_time'], $otrfn->getEpTime());
    }

    /**
     * @param $filename
     * @param $expect
     * @dataProvider provideSeries
     */
    public function testGetSender($filename, $expect)
    {
        $otrfn = new OtrFile($filename);
        $this->assertEquals($expect['sender'], $otrfn->getSender());
    }

    /**
     * @param $filename
     * @param $expect
     * @dataProvider provideSeries
     */
    public function testGetLang($filename, $expect)
    {
        $otrfn = new OtrFile($filename);
        $this->assertEquals($expect['lang'], $otrfn->getLang());
    }

    /**
     * @param $filename
     * @param $expect
     * @dataProvider provideSeries
     */
    public function testGetEpDateTime($filename, $expect)
    {
        $otrfn = new OtrFile($filename);
        $dateParts = explode('.', $expect['ep_date']);
        $timeParts = explode('-', $expect['ep_time']);
        $dtString = sprintf("%s.%s.20%s %s:%s", $dateParts[2], $dateParts[1], $dateParts[0], $timeParts[0], $timeParts[1]);
        $this->assertEquals($dtString, $otrfn->getEpDateTime()->format('d.m.Y H:i'));
    }

    public function provideSeries()
    {
        return [
            [
                'Navy_CIS__L_A__14.11.23_21-15_sat1_60_TVOON_DE.mpg.HQ.avi.otrkey',
                [
                    'show' => 'Navy CIS L A',
                    'ep_date' => '14.11.23',
                    'ep_time' => '21-15',
                    'sender' => 'sat1',
                    'lang' => 'de',
                ]
            ],
            [
                'Bones_Die_Knochenjaegerin_10.08.26_22-15_rtl_55_TVOON_DE.mpg.avi.otrkey',
                [
                    'show' => 'Bones Die Knochenjaegerin',
                    'ep_date' => '10.08.26',
                    'ep_time' => '22-15',
                    'sender' => 'rtl',
                    'lang' => 'de',
                ]
            ],
            [
                'Judge_Judy_14.11.19_16-30_uswcbs_30_TVOON_DE.mpg.mp4.otrkey',
                [
                    'show' => 'Judge Judy',
                    'ep_date' => '14.11.19',
                    'ep_time' => '16-30',
                    'sender' => 'wcbs',
                    'lang' => 'us',
                ]
            ]
        ];
    }

    public function testGetExtension()
    {
        $file = new OtrFile('Navy_CIS__L_A__14.11.23_21-15_sat1_60_TVOON_DE.mpg.HQ.avi.otrkey');
        $this->assertEquals('otrkey', $file->getExtension());
    }
}

 