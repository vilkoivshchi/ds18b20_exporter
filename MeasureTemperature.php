<?php

class MeasureTemperature
{
    public function Measure()
    {
        $envTempArray = [];
        $directory = '/sys/bus/w1/devices';
        $dirList = scandir($directory);

        foreach($dirList as $device)
        {
            if(preg_match('/^(28-){1}/', $device) == 1)
            {
                $devider = 1;
                $resolution = file_get_contents($directory . "/" . $device . "/resolution");

                switch ((int)$resolution)
                {
                    case 9:
                        $devider = 1000;
                        break;
                    case 10:
                        $devider = 10000;
                        break;
                    case 11:
                        $devider = 100000;
                        break;
                    case 12:
                        $devider = 1000000;
                        break;

                }
                $temperature = file_get_contents($directory . "/" . $device . "/temperature");
                if($temperature)
                {
                    $envTempArray["env_temp"] = array("sn"=>$device, "temperature"=>(int)$temperature/$devider);
                }
                else
                {
                    $envTempArray["env_temp"] = array("sn"=>-1, "temperature"=>-255);
                }
            }
        }
        return $envTempArray;
    }
}
?>
