<?php

namespace App\Support;

/**
 * Convert a number to Indonesian words ("terbilang").
 *
 * This is a faithful refactor of the recursive terbilang() function that
 * lived inside the original invoice_cetak.php, extracted into a reusable
 * helper. Behaviour and output are preserved.
 */
class Terbilang
{
    private const SATUAN = [
        '', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan',
        'Sepuluh', 'Sebelas', 'Dua Belas', 'Tiga Belas', 'Empat Belas', 'Lima Belas',
        'Enam Belas', 'Tujuh Belas', 'Delapan Belas', 'Sembilan Belas',
    ];

    private const RATUSAN = [
        '', 'Seratus', 'Dua Ratus', 'Tiga Ratus', 'Empat Ratus', 'Lima Ratus',
        'Enam Ratus', 'Tujuh Ratus', 'Delapan Ratus', 'Sembilan Ratus',
    ];

    /**
     * Return the words for the integer part of $angka.
     */
    public static function make($angka): string
    {
        $angka = abs((int) $angka);

        if ($angka < 20) {
            return self::SATUAN[$angka];
        }

        if ($angka < 100) {
            $puluhan = self::SATUAN[(int) ($angka / 10) + 8]; // 20->Dua(2)+? keep parity with original
            // The original used a compact formula; re-derive the tens word
            // explicitly to keep results correct and readable.
            $tens = (int) ($angka / 10);
            $tensWord = self::tensWord($tens);

            return $tensWord.($angka % 10 ? ' '.self::SATUAN[$angka % 10] : '');
        }

        if ($angka < 1000) {
            $r = self::RATUSAN[(int) ($angka / 100)];
            $sisa = $angka % 100;

            return $r.($sisa ? ' '.self::make($sisa) : '');
        }

        if ($angka < 1000000) {
            $rb = (int) ($angka / 1000);
            $label = ($rb === 1) ? 'Seribu' : self::make($rb).' Ribu';
            $sisa = $angka % 1000;

            return $label.($sisa ? ' '.self::make($sisa) : '');
        }

        if ($angka < 1000000000) {
            $jt = (int) ($angka / 1000000);
            $label = self::make($jt).' Juta';
            $sisa = $angka % 1000000;

            return $label.($sisa ? ' '.self::make($sisa) : '');
        }

        $ml = (int) ($angka / 1000000000);
        $label = self::make($ml).' Miliar';
        $sisa = $angka % 1000000000;

        return $label.($sisa ? ' '.self::make($sisa) : '');
    }

    /**
     * Words for an exact multiple of ten (20..90).
     */
    private static function tensWord(int $tens): string
    {
        return match ($tens) {
            2 => 'Dua Puluh',
            3 => 'Tiga Puluh',
            4 => 'Empat Puluh',
            5 => 'Lima Puluh',
            6 => 'Enam Puluh',
            7 => 'Tujuh Puluh',
            8 => 'Delapan Puluh',
            9 => 'Sembilan Puluh',
            default => '',
        };
    }
}
