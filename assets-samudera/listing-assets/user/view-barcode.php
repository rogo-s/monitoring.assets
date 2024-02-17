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

    $sql = "SELECT dac.nik, dac.nik_firstuser, dac.nik, dac.staff_name, dac.brand_id, dac.serial_number, dac.laptop_type,
        stf.staf_name, dvt.dvt_name, br.brand_name, dom.domain_name
      FROM device_assets_computer dac 
      LEFT JOIN tbl_staf stf ON dac.nik_firstuser = stf.nik
      LEFT JOIN tbl_dvt dvt ON dac.dvt_id = dvt.dvt_id 
      LEFT JOIN tbl_brand br ON dac.brand_id = br.brand_id 
      LEFT JOIN tbl_domain dom ON dac.domain_id = dom.domain_id 
      WHERE dac.device_id=$id";

    $query = $db->query($sql);

    while ($row = mysqli_fetch_array($query)) {
        $exOwner = ($row['nik_firstuser']  === NULL) ? "" : $row['staf_name'];
        if ($row['brand_id']  != NULL) {
            $field1 = "Merek";
            $field2 = "Serial Number";
            $fieldDetail1 = $row['brand_name'] . ' - ' . $row['laptop_type'];
            $fieldDetail2 = $row['serial_number'];
        } else {
            $field1 = "PC-Name";
            $field2 = "Domain";
            $fieldDetail1 = $row['serial_number'];
            $fieldDetail2 = $row['domain_name'];
        }

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
      <p style="text-align: center;">&nbsp;<strong>SURAT KEPEMILIKAN ASSET</strong></p>
      <p style="text-align: justify;">Pada, ' . $today . ' yang bertanda tangan di bawah ini :</p>
      
      <p style="text-align: left;">Nama&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : '  . $row['staff_name'] . '</p>
      <p style="text-align: left;">NIK&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: '  . $row['nik'] . '</p>
      <p style="text-align: left;">Perusahaan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: PT. Masaji Tatanan Kontainer Indonesia</p>
      <p style="text-align: left;">Selanjutnya di sebut <strong>JENIS BARANG</strong></p>
      <p style="text-align: left;"><strong>PIHAK PENERIMA</strong> menerima asset barang dari perusahaan <strong>PT MASAJI TATANAN KONTAINER INDONESIA</strong> dan <strong>BERTANGGUNG JAWAB </strong>menjalankan amanah dengan penuh tanggung jawab <strong> ASSET</strong>, berupa daftar terlampir :</p>
      <table style="height: 82px;" border="1" width="541">
      <tbody>
      <tr style="height: 20px;">
      <td style="width: 173.875px; text-align: center; height: 20px;"><strong>' . $field1 . '</strong></td>
      <td style="width: 173.875px; text-align: center; height: 20px;"><strong>' . $field2 . '</strong></td>
      <td style="width: 173.917px; text-align: center; height: 20px;"><strong>Jenis</strong></td>
      </tr>
      <tr style="height: 20px;">
      <td style="width: 173.875px; height: 20px;">' . $fieldDetail1 . '</td>
      <td style="width: 173.875px; height: 20px;">'  . $fieldDetail2 . '</td>
      <td style="width: 173.917px; height: 20px;"><strong>' . $row['dvt_name'] . '</strong></td>
      </tr>
      <tr style="height: 20.1042px;">
      <td style="width: 173.875px; height: 20.1042px;">&nbsp;</td>
      <td style="width: 173.875px; height: 20.1042px;">&nbsp;</td>
      <td style="width: 173.917px; height: 20.1042px;">&nbsp;</td>
      </tr>
      </tbody>
      </table>
      <p style="text-align: justify;">Demikian berita acara serah terima barang ini di buat oleh IT SUPPORT. Adapun barang barang tersebut dalam keadaan baru dan baik. Sejak penanda tanganan berita acara ini, maka barang tersebut menjadi tanggung jawab <strong>PIHAK PERTAMA</strong>, untuk memelihara dan merawat dengan baik serta di pergunakan untuk keperluan perusahaan PT. Masaji Tatanan Kontainer Indonesia.</p>
      
      <table style="height: 50px; width: 428px;" border="1">
      <tbody>
      <tr style="height: 19px;">
      <td style="width: 249.583px; height: 19px; text-align: center;"><strong>GAMBAR ASSET</strong></td>
      <td style="width: 246.417px; height: 19px; text-align: center;"><strong>PIHAK PERTAMA</strong></td>
      </tr>
      <tr style="height: 63.6667px;">
      <td style="width: 249.583px; height: 63.6667px; text-align: center;">
      <p>&nbsp;</p>
      <p><br></p>
      <p>(IT SUPPORT)</p>
      <p>&nbsp;</p>
      </td>
      <td style="width: 246.417px; height: 63.6667px; text-align: center;">
      <p>&nbsp;</p>
      <p><br></p>
      <p>&nbsp;( '  . $row['staff_name'] .  ' )</p>
      <p>&nbsp;</p>
      </td>
      </tr>
      </tbody>
      </table>

      <p style="text-align: justify;">&nbsp;</p>
      <p style="text-align: justify;"><strong>&nbsp;</strong></p>
      <p style="text-align: justify;">&nbsp;</p>
      <p style="text-align: justify;"><strong>&nbsp;</strong></p>
      <p style="text-align: justify;"><strong>&nbsp;</strong></p>
      <p style="text-align: justify;">&nbsp;</p>
      <p style="text-align: justify;">&nbsp;</p>';

        // Buat objek TCPDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdfName = $row['nik'] . '_' . $row['serial_number'] . '.' . 'pdf';

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
