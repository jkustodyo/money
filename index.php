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
//echo "(((($texto))))";
//return 11111;
	$str_json="{";
	foreach($arr as $item){
		$str="";
		if(substr($item,0,5)=='!Type'	)	$str="{'Tipo'=>'"		.substr($item,6)."'"		;else
		if(substr($item,0,1)=='L'		)	$str="{'Lancamento'=>'"	.substr($item,1)."'"		;else
		if(substr($item,0,1)=='P'		)	$str="{'Favorecido'=>'"	.substr($item,1)."'"		;else
		if(substr($item,0,1)=='D'		)	$str="{'Data'=>'"		.substr($item,1)."'"		;else
		if(substr($item,0,1)=='T'		)	$str="{'Valor'=>'"		.substr($item,1)."'"		;else
		if($item!='')						$str="{'Obs'=>'$item'";else continue;
//											$str="{'Obs'=>'$item'";
		$str_json.="$str},";
	}
	return "$str_json}";

	$ret="";
	$tam=strlen($texto);
	for($i=0;$i<$tam;$i++){
		if($texto[$i]==chr(13))
			$ret.="@@!!@@";
		else
			$ret.=$texto[$i];
			
	}
	return [$arr,$ret];
	return [$arr,$ret];
}

?> 
