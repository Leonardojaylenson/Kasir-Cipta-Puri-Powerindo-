<?php
require_once(ROOTPATH . 'Vendor/autoload.php'); // Adjust the path as necessary

class CustomPDF extends TCPDF {
    private $logoPath;

    public function __construct($logoPath, $orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = 'UTF-8', $diskcache = true, $pdfa = false) {
        $this->logoPath = $logoPath;
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);
    }

    // Page header
    public function Header() {
        $this->SetAlpha(0.2);

        // Get page dimensions
        $pageWidth = $this->getPageWidth();
        $pageHeight = $this->getPageHeight();

        // Set margins
        $leftMargin = $this->lMargin;
        $rightMargin = $this->rMargin;
        $topMargin = $this->tMargin;

        // Calculate image dimensions
        $imageWidth = $pageWidth - ($leftMargin + $rightMargin); // Full page width minus margins
        $imageHeight = 0; // Height set to 0 to maintain aspect ratio

        // Position and add the image
        $this->Image($this->logoPath, $leftMargin, $topMargin, $imageWidth, $imageHeight, 'PNG', '', 'T', true, 150, '', false, false, 0, false, false, false);
        $this->SetAlpha(1); // Reset opacity to default
    }

    // Page footer
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, 0, 'C');
    }
}

// Create a new TCPDF instance using the custom class
$logoPath = 'images/' . (isset($setting->tab_icon) ? $setting->tab_icon : 'default-icon.png');
$pdf = new CustomPDF($logoPath, 'P', 'mm', 'A4', true, 'UTF-8', false, false); 

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Nota');
$pdf->SetSubject('Nota');

// Set margins
$leftMargin = 10;
$rightMargin = 10;
$topMargin = 10;
$bottomMargin = 10;
$pdf->SetMargins($leftMargin, $topMargin, $rightMargin);

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 10);

// Get data from view variables
$websiteName = isset($setting->judul_website) ? $setting->judul_website : 'Default Website';
$startDate = isset($startDate) ? $startDate : '0000-00-00';
$endDate = isset($endDate) ? $endDate : '9999-12-31';

// Add report title
$pdf->SetXY($leftMargin, $topMargin + 10); // Set X and Y position
$pdf->SetFont('helvetica', 'B', 16); // Larger font for report title
$pdf->Cell(0, 10, 'Laporan Barang Keluar', 0, 1, 'L'); // Report title, aligned to the left

// Add website name and date range
$pdf->SetXY($leftMargin, $topMargin + 25); // Adjust Y position for the website name and date range
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, $websiteName, 0, 1, 'L'); // Website name, aligned to the left
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, 'Tanggal : ' . $startDate . ' - ' . $endDate, 0, 1, 'L'); // Date range, aligned to the left

// Prepare HTML content
$html = '<table border="1" cellspacing="0" cellpadding="4">';
$html .= '<thead><tr><th>Nama Barang</th><th>Kode Barang</th><th>Jumlah</th><th>Harga Jual</th><th>Total Harga</th><th>Tanggal</th></tr></thead>';
$html .= '<tbody>';

// Add items and calculate total
$totalAmount = 0;
foreach ($satu as $item) {
    $itemTotal = $item->jumlah * $item->harga_jual; // Calculate total for each item
    
    // Format create_at to show only the date
    $createDate = (new DateTime($item->create_at))->format('d-m-Y');

    $html .= '<tr>';
    $html .= '<td>' . htmlspecialchars($item->nama_barang, ENT_QUOTES, 'UTF-8') . '</td>';
    $html .= '<td>' . htmlspecialchars($item->kode_barang, ENT_QUOTES, 'UTF-8') . '</td>';
    $html .= '<td>' . htmlspecialchars($item->jumlah, ENT_QUOTES, 'UTF-8') . '</td>';
    $html .= '<td>' . number_format($item->harga_jual, 2, ',', '.') . '</td>';
    $html .= '<td>Rp ' . number_format($itemTotal, 2, ',', '.') . '</td>'; // Display total for each item
    $html .= '<td>' . htmlspecialchars($createDate, ENT_QUOTES, 'UTF-8') . '</td>'; // Display only the date
    $html .= '</tr>';
    $totalAmount += $itemTotal; // Add item total to overall total
}

$html .= '</tbody>';
$html .= '</table>';

// Output the HTML table
$pdf->writeHTML($html, true, false, true, false, '');

// Add total amount below the table
$pdf->Ln(-7); // Add a line break with a small vertical space
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(150, 10, 'Total', 0, 0, 'R'); // Label "Total", aligned to the right
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, 'Rp ' . number_format($totalAmount, 2, ',', '.'), 0, 1, 'R'); // Total amount, aligned to the right

// Output PDF directly to the browser
$pdfContent = $pdf->Output('nota.pdf', 'S'); // 'S' returns the PDF as a string

header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="nota.pdf"');
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');
header('Content-Length: ' . strlen($pdfContent));
ob_clean();
flush();
echo $pdfContent;

// Exit the script
exit;
?>
