<?php

namespace OtrRenamer\Entity;


class OtrFile
{
    const REGEX_GROUP_EP_DATE = 2;
    const REGEX_GROUP_SHOW = 1;
    const REGEX_GROUP_EP_TIME = 3;
    const REGEX_GROUP_SENDER = 4;
    private $filename;
    private $extension;
    private $show;
    private $epDate;
    private $epTime;
    private $sender;
    private $lang;
    /**
     * @var \DateTime
     */
    private $epDateTime;

    /**
     * @param string $filename
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->parseFileInfo();
    }

    private function parseFileInfo()
    {
        /**
         * # Get Title, date and so on from filename
         * self.extension = os.path.splitext(self.file)[1]
         * m = re.search("(.*)_([0-9]{2}\.[0-9]{2}\.[0-9]{2})_([0-9]{2}\-[0-9]{2})_([A-Za-z0-9]+)", self.file)
         * title = m.group(1)
         * title = title.split('__')[0] # for US series SeriesName__EpisodeTitle (problems with shows like CSI__NY)
         * self.show = title.replace("_",' ')
         * self.epdate = m.group(2)
         * self.eptime = m.group(3)
         * self.sender = m.group(4)
         * if self.sender[:2] != 'us':
         * self.lang='de'
         * else:
         * self.lang='us'
         * print self.lang
         */
        $file = new \SplFileInfo($this->filename);
        $this->extension = $file->getExtension();

        $regex = '/(.*)_([0-9]{2}\.[0-9]{2}\.[0-9]{2})_([0-9]{2}\-[0-9]{2})_([A-Za-z0-9]+)/';
        preg_match($regex, $this->filename, $matches);

        $this->setShow($matches[self::REGEX_GROUP_SHOW]);
        $this->epDate = $matches[self::REGEX_GROUP_EP_DATE];
        $this->epTime = $matches[self::REGEX_GROUP_EP_TIME];
        $this->sender = $matches[self::REGEX_GROUP_SENDER];
        $this->setLanguage();
        $this->parseEpDateTime();
    }

    private function setShow($match)
    {
        $title = str_replace('_', ' ', $match);
        $this->show = trim(preg_replace('/\s{2,}/i', ' ', $title));
    }

    private function setLanguage()
    {
        if (strpos($this->sender, 'us') === 0) {
            $this->lang = 'us';
            $this->sender = substr($this->sender, 2);
        } else {
            $this->lang = 'de';
        }
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function getShow()
    {
        return $this->show;
    }

    public function getEpDate()
    {
        return $this->epDate;
    }

    public function getEpTime()
    {
        return $this->epTime;
    }

    public function getSender()
    {
        return $this->sender;
    }

    public function getLang()
    {
        return $this->lang;
    }

    private function parseEpDateTime()
    {
        $this->epDateTime = \DateTime::createFromFormat('y.m.d H-i', sprintf("%s %s", $this->epDate, $this->epTime));
    }

    /**
     * @return \DateTime
     */
    public function getEpDateTime()
    {
        return $this->epDateTime;
    }

} 