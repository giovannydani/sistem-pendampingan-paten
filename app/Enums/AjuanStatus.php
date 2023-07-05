<?php
namespace App\Enums;

// App\Enums\AjuanStatus

enum AjuanStatus : string {
    case AdminProcess = "ADMPRC";
    case Revision = "RVS";
    case Finish = "FNS";

    public function text() : string
    {
        if ($this === self::AdminProcess) {
            return "Menunggu di proses admin";
        }elseif ($this === self::Revision) {
            return "Revisi";
        }elseif ($this === self::Finish) {
            return "Selesai";
        }
    }

    public function isAdminProcess() : bool
    {
        return $this === self::AdminProcess;
    }

    public function isRevision() : bool
    {
        return $this === self::Revision;
    }

    public function isFinish() : bool
    {
        return $this === self::Finish;
    }

    public static function getArrayValue() : array
    {
        $data = [];

        foreach (self::cases() as $case) {
            $data[] = $case->value;
        }

        return $data;
    }
}
?>