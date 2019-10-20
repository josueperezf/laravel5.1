<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//  las siguientes lineas es para generarTabla
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\TablePosition;
//ENLACES BUENOS para tablas
//https://stackoverflow.com/questions/38124184/how-to-make-the-table-in-word-using-phpword-which-includes-multiple-rowspan-and
// https://github.com/PHPOffice/PHPWord/blob/develop/samples/Sample_09_Tables.php
// https://phpword.readthedocs.io/en/latest/elements.html?highlight=table
class GenerarPlanillaDocController extends Controller
{
    public function generarDesdePlantilla(){
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('plantillaPrueba.docx');
        //la siguiente lienas muestras las variables de la plantilla a las q no se les ha asignado valor aun
        //var_dump( $templateProcessor->getVariables() );
        $templateProcessor->setValue('nombre_empresa', 'JL SOFTWARE');
        $templateProcessor->setValue('direccion_empresa', 'san cristobal y quillota');
        $temp_file = tempnam(sys_get_temp_dir(), 'PHPWord');
        $templateProcessor->saveAs($temp_file);
        header("Content-Disposition: attachment; filename=myFile.docx");
        readfile($temp_file);
        unlink($temp_file); 
    }
    //ejemplo para generar un word desde cero sin plantilla
    public function generarDoc(){
        $wordTest = new \PhpOffice\PhpWord\PhpWord();
        $newSection = $wordTest->addSection();
        $desc1 = "The Portfolio details is a very useful feature of the web page. You can establish your archived details and the works to the entire web community. It was outlined to bring in extra clients, get you selected based on this details.";
        $newSection->addText($desc1, array('name' => 'Tahoma', 'size' => 15, 'color' => 'red'));
        $objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($wordTest, 'Word2007');
        try {
            $objectWriter->save(storage_path('TestWordFile.docx'));
        } catch (Exception $e)
        {
            
        }
        return response()->download(storage_path('TestWordFile.docx'));
    }
    public function generarTabla(){
        // New Word Document
        // echo date('H:i:s'), ' Create new PhpWord object', EOL;
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $fancyTableStyleName = 'Fancy Table';
        $fancyTableStyle = array('borderSize' => 1,'valign' => 'center', 'align' => 'center', 'borderColor' => '006699', 'cellMargin' => 0,  'cellSpacing' => 1);
        //$fancyTableFirstRowStyle = array('borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF');
        $fancyTableCellStyle = array('valign' => 'center');
        $fancyTableCellBtlrStyle = array('valign' => 'center');
        $fancyTableFontStyle = array('bold' => true);
        $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle);

        
        $header = array('size' => 16, 'bold' => true);
        // 1. Basic table
        $rows = 10;
        $cols = 5;
        $section->addText('Basic table', $header);
        $table = $section->addTable($fancyTableStyleName);
        for ($r = 1; $r <= 8; $r++) {
            $table->addRow();
            for ($c = 1; $c <= 5; $c++) {
                $table->addCell(1750)->addText("Row {$r}, Cell {$c}", array('bold' => true), array('alignment' => 'center') );
            }
        }
        
        $objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            //$objectWriter->save(storage_path('TestWordFile.docx'));
            $temp_file = tempnam(sys_get_temp_dir(), 'PHPWord');
            $objectWriter->save($temp_file);
            header("Content-Disposition: attachment; filename=myFile.docx");
            readfile($temp_file);
            unlink($temp_file); 
        } catch (Exception $e)
        {
            
        }
    }
}