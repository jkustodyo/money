<?php
ob_start();

//$arr=explode("^",separarCampos(abrirArquivo("mov.txt")));
$arr=explode("^",abrirArquivo("mov.txt"));

foreach ($arr as $item => $val){
	echo "<br><br>$item=>$val<br>";
//	echo(separarCampos($val));
	print_r(separarCampos($val));
}




function abrirArquivo($arq){
//echo "arq($arq)";

	$a = fopen($arq,"r");
	echo $a."<br>";
	$ret="";
	while (!feof ($a)){
		$ret.= fgets($a,8192);

	}
	fclose($a);
	return $ret;
}

function separarCampos($texto){
	$texto=str_replace(chr(10),"",$texto);
	$arr=explode(chr(13),$texto);
print_r($arr);echo "<br>";
	$str_json="{";
	$detalhe=0;
	foreach($arr as $item){
		$str="";
		if(substr($item,0,5)=='!Type'	)	$str="{'Tipo'=>'"								.substr($item,6)."'"		;else
		if(substr($item,0,1)=='L'		)	$str="{'Lancamento'=>'"							.substr($item,1)."'"		;else
		if(substr($item,0,1)=='S'		)	$str="{'Lancamento_".(++$detalhe)."'=>'"		.substr($item,1)."'"		;else
		if(substr($item,0,1)=='$'		)	$str="{'Valor_".$detalhe."'=>'"					.substr($item,1)."'"		;else
		if(substr($item,0,1)=='E'		)	$str="{'Memo_".$detalhe."'=>'"					.substr($item,1)."'"		;else
		if(substr($item,0,1)=='P'		)	$str="{'Favorecido'=>'"							.substr($item,1)."'"		;else
		if(substr($item,0,1)=='D'		)	$str="{'Data'=>'"								.substr($item,1)."'"		;else
		if(substr($item,0,1)=='T'		)	$str="{'Valor'=>'"								.substr($item,1)."'"		;else
		if(substr($item,0,1)=='M'		)	$str="{'Memo'=>'"								.substr($item,1)."'"		;else
		if(substr($item,0,1)=='N'		)	$str="{'Documento'=>'"							.substr($item,1)."'"		;else
		if($item!='')						$str="{'Obs'=>'$item'";else continue;
		$str_json.="$str},";
	}
	return "$str_json}";
}

?> 
