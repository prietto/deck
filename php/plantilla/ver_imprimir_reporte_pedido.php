<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>TeatroLaMascara.com</title>
<link href="../../estilos/estilo_general.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center"><br />
            <table width="80%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left"><span class="contenido"><strong> PEDIDO Nro.
                <?=$cod_pedido?>
                <br />
Gracias por su solicitud              </strong></span></td>
            </tr>
            </table>
            <br />
            <br />
            <br />
            <table width="80%" border="0" cellpadding="2" cellspacing="0" bordercolor="#333333">
              <tr>
                <td align="left" valign="top" class="contenido"><span class="contenido"><strong>Espectaculo</strong>:</span></td>
                <td align="left" valign="top" class="contenido"><span class="contenido">
                  <?=$txt_nombre_evento?>
                </span></td>
              </tr>
              <tr>
                <td align="left" valign="top" class="contenido"><span class="contenido"><strong>Presenta</strong>:</span></td>
                <td align="left" valign="top" class="contenido"><span class="contenido">
                  <?=$txt_grupo?>
                </span></td>
              </tr>
              <tr>
                <td align="left" valign="top" class="contenido"><span class="contenido"><strong>D&iacute;a Funci&oacute;n:</strong></span></td>
                <td align="left" valign="top" class="contenido" ><span class="contenido">
                  <?=$fec_funcion_largo?>
                </span></td>
              </tr>
              <tr>
                <td align="left" valign="top" class="contenido"><span class="contenido"><strong>Lugar:</strong></span></td>
                <td align="left" valign="top" nowrap="nowrap" class="contenido"><span class="contenido">Teatro la mascara </span></td>
              </tr>
              <tr>
                <td align="left" valign="top" class="contenido"><span class="contenido"><strong>Direcci&oacute;n:</strong></span></td>
                <td align="left" valign="top" class="contenido" ><span class="contenido">Cra 10, No 3-40 Barrio San Antonio</span></td>
              </tr>
              <tr>
                <td align="left" valign="top"  class="contenido">&nbsp;</td>
                <td align="left" valign="top"  class="contenido">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="top"  class="contenido"><span class="contenido"><strong>Nombre: </strong></span></td>
                <td align="left" valign="top"  class="contenido">                <span class="contenido">
                  <?=$txt_nombre?>              
                </span></td>
              </tr>
            <tr>
              <td align="left" valign="top" class="contenido"><span class="contenido"><strong>Direcci&oacute;n:</strong></span></td>
              <td align="left" valign="top" class="contenido">                <span class="contenido">
                <?=$txt_direccion?>              
                </span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="contenido"><span class="contenido"><strong>Tel&eacute;fono:</strong></span></td>
              <td align="left" valign="top" class="contenido">                <span class="contenido">
                <?=$txt_telefono?>              
                </span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="contenido"><span class="contenido"><strong>E- Mail:</strong></span></td>
              <td align="left" valign="top" class="contenido">                <span class="contenido">
                <?=$txt_email_comprador?>              
                </span></td>
            </tr>
            <? if($txt_comentario){?>
            <tr class="contenido">
              <td  align="left" valign="top" class="titulo_blanco"><span class="contenido"><strong>Comentarios:</strong></span></td>
              <td  align="left" valign="top" class="titulo_blanco">                <span class="contenido">
                <?=$txt_comentario?>              
                </span></td>
            </tr>
            <? } ?>
        </table></td>
          <td width="50%" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="right"><img src="../../imagenes/sistema/logo_parte_1.jpg" width="98" height="90" /></td>
            </tr>
          </table>
            <br />
            <table width="60%" border="0" cellpadding="3" cellspacing="0" bordercolor="#FF3300" >
              <tr class="texto_negro">
                <td colspan="3" align="left"><table width="100%" border="0" cellspacing="3" cellpadding="0">
                  <tr>
                    <td align="left" class="texto_negro"><span class="contenido"><strong>INFORMACI&Oacute;N DE SU SOLICITUD</strong></span></td>
                  </tr>
                </table></td>
              </tr>
              <tr class="texto_negro">
                <td align="left"><span class="contenido"><strong>LOCALIDAD</strong></span></td>
                <td align="left"><span class="contenido"><strong>SILLA</strong></span></td>
                <td align="right"><span class="contenido"><strong>PRECIO</strong></span></td>
              </tr>
              <?
										$sum_precio = 0;//SUMATORIA
										while ( $row= 	$db->sacar_registro($cursor_pedido)){
											$txt_localidad	= $row['txt_localidad'];
											$nom_silla		= $row['nom_silla'];											
											$val_precio		= $sis_genericos->formato_numero($row['val_precio']);
											$sum_precio		= $sum_precio+$row['val_precio'];
										?>
              <tr>
                <td align="left" class="titulo_blanco"><span class="contenido">
                  <?=$txt_localidad?>
                </span></td>
                <td align="left" nowrap="nowrap" class="titulo_blanco"><span class="contenido">
                  <?=$nom_silla?>
                </span></td>
                <td align="right" nowrap="nowrap" class="titulo_blanco"><span class="contenido">$
                  <?=$val_precio?>
                </span></td>
              </tr>
              <? } ?>
              <tr>
                <td colspan="2" align="left" nowrap="nowrap" class="titulo_submenu">&nbsp;</td>
                <td align="right" nowrap="nowrap" class="titulo_submenu">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" align="left" nowrap="nowrap" ><span class="contenido"><strong>Sub Total</strong></span></td>
                <td align="right" nowrap="nowrap" class="texto_negro"><span class="contenido"><strong> $
                  <?=$sis_genericos->formato_numero($sum_precio)?>
                </strong></span></td>
              </tr>
              <tr>
                <td colspan="2" align="left" nowrap="nowrap" ><span class="contenido"><strong>Gastos Envio </strong></span></td>
                <td align="right" nowrap="nowrap" ><span class="contenido"><strong> $
                  <?=$sis_genericos->formato_numero($val_envio)?>
                </strong></span></td>
              </tr>
              <? if($val_total_descuento){?>
              <tr>
                <td colspan="2" align="left" nowrap="nowrap" ><span class="contenido"><strong>Descuento</strong></span></td>
                <td align="right" nowrap="nowrap" ><span class="contenido"><strong> $
                  <?=$sis_genericos->formato_numero($val_total_descuento)?>
                </strong></span></td>
              </tr>
              <? } ?>
              <tr>
                <td colspan="2" align="left" nowrap="nowrap" ><span class="contenido"><strong>Total</strong></span></td>
                <td align="right" nowrap="nowrap" class="titulo_submenu"><span class="contenido"><strong>$
                  <?=$sis_genericos->formato_numero($val_envio+$sum_precio-$val_total_descuento)?>
                </strong></span></td>
              </tr>
          </table></td>
          <td align="left" valign="top"><img src="../../imagenes/sistema/logo_parte_2.jpg" width="27" height="181" /></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="50" align="center" valign="top" class="titulo_negro"><strong> ESTE REPORTE NO ES VALIDO PARA INGRESAR </strong></td>
        </tr>
        <tr>
          <td align="center" valign="top" class="pieResultado">www.TeatroLaMascara.com  - Todos los derechos reservados <br />
            Cra 10, No 3-40 Barrio San Antonio, Tel(2) 8936640 - contacto@teatrolamascara.com - Cali Colombia<br />
            Tecnologia desarrollada por D E C K</td>
        </tr>
      </table>
    <p>&nbsp;</p></td>
  </tr>
</table>
<script>
window.print();
</script>
</body>
</html>
