<?php
namespace App\Enums;

// App\Enums\AjuanStatus

enum AjuanStatus : string {
    case AdminCheck = "ADMCHK";
    case Revision = "RVS";
    case AdminProcess = "ADMPRC";
    case CertificateFinish = "CTFFNS";
    case UploadPayment = "UPPAY";
    case PaymentFailed = "PAYFAIL";
    case Finish = "FNS";

    public function text() : string
    {
        if ($this === self::AdminCheck) {
            return "Menunggu di periksa oleh admin";
        }
        elseif ($this === self::Revision) {
            return "Revisi";
        }
        elseif ($this === self::AdminProcess) {
            return "Menunggu surat pencatatan di proses admin";
        }
        elseif ($this === self::CertificateFinish) {
            return "Menunggu pembayaran";
        }
        elseif ($this === self::UploadPayment) {
            return "Menunggu verifikasi pembayaran";
        }
        elseif ($this === self::PaymentFailed) {
            return "Pembayaran gagal";
        }
        elseif ($this === self::Finish) {
            return "Ajuan telah selesai di proses";
        }
    }

    public function isAdminCheck() : bool
    {
        return $this === self::AdminCheck;
    }

    public function isRevision() : bool
    {
        return $this === self::Revision;
    }

    public function isAdminProcess() : bool
    {
        return $this === self::AdminProcess;
    }

    public function isCertificateFinish() : bool
    {
        return $this === self::CertificateFinish;
    }

    public function isUploadPayment() : bool
    {
        return $this === self::UploadPayment;
    }

    public function isPaymentFailed() : bool
    {
        return $this === self::PaymentFailed;
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