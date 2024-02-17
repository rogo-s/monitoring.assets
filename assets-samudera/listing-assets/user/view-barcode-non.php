<?php
include("../config.php");
require_once('../tcpdf/tcpdf.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $date = date('d');
    $month = date('n'); // Mengambil angka bulan (1-12)
    $year = date('Y');

    $nama_bulan = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );

    $month_indo = $nama_bulan[$month];

    $today = $date . ' ' . $month_indo . ' ' . $year;

    $sql = "SELECT dn.nonDev_id, dn.serial_number, dn.ip, dn.loc, 
            sts.status_device, dvt.dvt_name, br.brand_name,
            rp.startDate, rp.endDate, rp.vendor_name
            FROM tbl_non_device dn
            LEFT JOIN tbl_status sts ON dn.status_id = sts.status_id 
            LEFT JOIN tbl_dvt dvt ON dn.dvt_id = dvt.dvt_id
            LEFT JOIN tbl_brand br ON dn.brand_id = br.brand_id
            LEFT JOIN tbl_repair rp ON dn.serial_number = rp.serial_number
            WHERE dn.nonDev_id=$id";

    $query = $db->query($sql);

    while ($row = mysqli_fetch_array($query)) {
        $exOwner = ""; // Tidak ada informasi pemilik karena tidak ada perubahan

        $field1 = "Serial Number";
        $field2 = "Internet Protocol";
        $field3 = "Location";

        $fieldDetail1 = $row['serial_number'];
        $fieldDetail2 = $row['ip'];
        $fieldDetail3 = $row['loc'];

        $template =
            '<table style="height: 82px; width: 556.333px; margin-left: auto; margin-right: auto;" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr style="height: 74.6667px;">
                    <td style="width: 265px; height: 74.6667px; text-align: center;">
                        <p><img src="../../assets/img/black.png" alt="Logo Samudera" width="200" height="56" /></p>
                    </td>
                    <td style="width: 284.333px; height: 74.6667px; text-align: left;"><br><br>Masaji Tatanan Kontainer Indonesia<br />Jalan Cakung No. 15, RT.4/RW.3, Semper Timur, Cilincing, Jakarta Utara, Daerah Khusus Ibukota Jakarta 14130, JAKARTA UTARA 14120, Indonesia</td>
                </tr>
            </tbody>
            </table>
            <p style="text-align: center;">&nbsp;<strong>KETERANGAN ASSET </strong></p>
            <p style="text-align: justify;">Pada, ' . $today . ' yang tertera di bawah ini :</p>
            
            <p style="text-align: left;">Nama Asset&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : '  . $row['dvt_name'] . '</p>
            <p style="text-align: left;">Brand&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: '  . $row['brand_name'] .'</p>
            <p style="text-align: left;">Perusahaan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: PT. Masaji Tatanan Kontainer Indonesia</p>
            <p style="text-align: left;">Selanjutnya disebut <strong>DETAIL BARANG</strong></p>
            <p style="text-align: left;"><strong>PIHAK PERUSAHAAN</strong>menyediakan asset barang dari kebutuhan<strong>SUPPLY STOK ASSET</strong> dan <strong>BERTANGGUNG JAWAB </strong>menjalankan pemeliharaan terhadap <strong> ASSET</strong>, berupa daftar terlampir :</p>
            <table style="height: 82px;" border="1" width="541">
                <tbody>
                    <tr style="height: 20px;">
                        <td style="width: 173.875px; text-align: center; height: 20px;"><strong>' . $field1 . '</strong></td>
                        <td style="width: 173.875px; text-align: center; height: 20px;"><strong>' . $field2 . '</strong></td>
                        <td style="width: 173.917px; text-align: center; height: 20px;"><strong>' . $field3 . '</strong></td>
                    </tr>
                    <tr style="height: 20px;">
                        <td style="width: 173.875px; height: 20px;">' . $fieldDetail1 . '</td>
                        <td style="width: 173.875px; height: 20px;">'  . $fieldDetail2 . '</td>
                        <td style="width: 173.917px; height: 20px;">' . $fieldDetail3 . '</td>
                    </tr>
                    <tr style="height: 20.1042px;">
                        <td style="width: 173.875px; height: 20.1042px;">&nbsp;</td>
                        <td style="width: 173.875px; height: 20.1042px;">&nbsp;</td>
                        <td style="width: 173.917px; height: 20.1042px;">&nbsp;</td>
                    </tr>
                </tbody>
            </table>
            <p style="text-align: justify;">Demikian berita acara persediaan barang ini di buat oleh IT SUPPORT. Adapun barang barang tersebut dalam keadaan baru dan baik. Sejak penanda tanganan berita acara ini, maka barang tersebut menjadi tanggung jawab <strong>PIHAK PERUSAHAAN</strong>, untuk memelihara dan merawat dengan baik serta di pergunakan untuk keperluan perusahaan PT. Masaji Tatanan Kontainer Indonesia.</p>
            
            <p style="text-align: justify;">&nbsp;</p>
            <p style="text-align: justify;"><strong>&nbsp;</strong></p>
            <p style="text-align: justify;">&nbsp;</p>
            <p style="text-align: justify;"><strong>&nbsp;</strong></p>
            <p style="text-align: justify;"><strong>&nbsp;</strong></p>
            <p style="text-align: justify;">&nbsp;</p>
            <p style="text-align: justify;">&nbsp;</p>';

        // Buat objek TCPDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdfName = $row['serial_number'] . '.' . 'pdf';

        // Set informasi dokumen
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('PT. Masaji Tatanan Kontainer Indonesia');
        $pdf->SetTitle($pdfName);

        // Buat halaman baru
        $pdf->AddPage();

        // Tampilkan template HTML di dalam dokumen PDF
        $pdf->writeHTML($template, true, false, true, false, '');

        $pdf->Output($pdfName, 'I');
    }
}
?>
