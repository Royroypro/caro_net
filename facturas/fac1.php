<?php

use Greenter\Model\Client\Client;
use Greenter\Model\Company\Company;
use Greenter\Model\Company\Address;
use Greenter\Model\Sale\FormaPagos\FormaPagoContado;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Model\Sale\Legend;

require __DIR__ . '/vendor/autoload.php';

$see = require __DIR__ . '/config.php';

// Cliente
$client = (new Client())
    // 1 = DNI, 6 = RUC
    ->setTipoDoc('6')
    ->setNumDoc('20000000001')
    ->setRznSocial('EMPRESA X');

// Emisor
$address = (new Address())
    ->setUbigueo('150201')
    ->setDepartamento('LIMA')
    ->setProvincia('HUAURA')
    ->setDistrito('HUACHO')
    ->setUrbanizacion('-')
    ->setDireccion('CAL.AMAZONAS MZA. L LOTE. 2 (ASENT. HUM. MANZANARES 1ERA. ETAPA)')
    ->setCodLocal('0000'); // Codigo de establecimiento asignado por SUNAT, 0000 por defecto.

$company = (new Company())
    ->setRuc('20606725095')
    ->setRazonSocial('GRUPO CARONET E.I.R.L')
    ->setNombreComercial('CARONET')
    ->setAddress($address);

// Venta
$invoice = (new Invoice())
    ->setUblVersion('2.1')
    ->setTipoOperacion('0101') // Venta - Catalog. 51
    ->setTipoDoc('01') // Factura - Catalog. 01 
    ->setSerie('F001')
    ->setCorrelativo('00000001')
    ->setFechaEmision(new DateTime('2020-08-24 13:05:00-05:00')) // Zona horaria: Lima
    ->setFormaPago(new FormaPagoContado()) // FormaPago: Contado
    ->setTipoMoneda('PEN') // Sol - Catalog. 02
    ->setCompany($company)
    ->setClient($client)
    ->setMtoOperGravadas(100.00)
    ->setMtoIGV(18.00)
    ->setTotalImpuestos(18.00)
    ->setValorVenta(100.00)
    ->setSubTotal(118.00)
    ->setMtoImpVenta(118.00);

$item = (new SaleDetail())
    //para productos
    /* ->setCodProducto('P001') */
    //para servicios
    ->setCodProducto('S001')
    //para productos 

    /*  ->setUnidad('NIU') // Unidad - Catalog. 03 */

    ->setUnidad('ZZ') // Unidad - Catalog. 03 (ZZ = servicio)
    ->setCantidad(2)
    ->setMtoValorUnitario(50.00)
    ->setDescripcion('PRODUCTO 1')
    ->setMtoBaseIgv(100)
    ->setPorcentajeIgv(18.00) // 18%
    ->setIgv(18.00)
    ->setTipAfeIgv('10') // Gravado Op. Onerosa - Catalog. 07
    ->setTotalImpuestos(18.00) // Suma de impuestos en el detalle
    ->setMtoValorVenta(100.00)
    ->setMtoPrecioUnitario(59.00);

$legend = (new Legend())
    ->setCode('1000') // Monto en letras - Catalog. 52
    ->setValue('SON DOSCIENTOS TREINTA Y SEIS CON 00/100 SOLES');

$invoice->setDetails([$item])
    ->setLegends([$legend]);
$result = $see->send($invoice);

// Guardar XML firmado digitalmente.
$xmlName = $invoice->getName() . '.xml';
file_put_contents($xmlName, $see->getFactory()->getLastXml());
rename($xmlName, 'xml/' . $xmlName);
echo "xml generado";


// Verificamos que la conexión con SUNAT fue exitosa.
if (!$result->isSuccess()) {
    // Mostrar error al conectarse a SUNAT.
    echo 'Codigo Error: ' . $result->getError()->getCode();
    echo 'Mensaje Error: ' . $result->getError()->getMessage();
    exit();
}



// Guardamos el CDR
file_put_contents('R-' . $invoice->getName() . '.zip', $result->getCdrZip());
/*
* file: factura.php 
*/

$cdr = $result->getCdrResponse();

$code = (int)$cdr->getCode();

if ($code === 0) {
    echo 'ESTADO: ACEPTADA' . PHP_EOL;
    if (count($cdr->getNotes()) > 0) {
        echo 'OBSERVACIONES:' . PHP_EOL;
        // Corregir estas observaciones en siguientes emisiones.
        var_dump($cdr->getNotes());
    }
} else if ($code >= 2000 && $code <= 3999) {
    echo 'ESTADO: RECHAZADA' . PHP_EOL;
} else {
    /* Esto no debería darse, pero si ocurre, es un CDR inválido que debería tratarse como un error-excepción. */
    /*code: 0100 a 1999 */
    echo 'Excepción';
}

echo $cdr->getDescription() . PHP_EOL;
