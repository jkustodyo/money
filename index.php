<?php
ob_start();
$arrDados=[		['!Type:'	,'Tipo'				],
				['L'		,'Lancamento'		],
				['S'		,'Lancamento_##'	],
				['$'		,'Valor_#'			],
				['E'		,'Memo_#'			],
				['P'		,'Favorecido'		],
				['D'		,'Data'				],
				['T'		,'Valor'			],
				['M'		,'Memo'				],
				['N'		,'Documento'		],
				[''			,'Obs'				]	];

$arr=explode("^",abrirArquivo("mov.txt"));

foreach ($arr as $item => $val){
	echo "<br><br>$item=>$val<br>";
//	echo(separarCampos($val));
	print_r(separarCampos($val));
}

function abrirArquivo($arq){$ret="";$a=fopen($arq,"r");while(!feof($a))$ret.=fgets($a,8192);fclose($a);return $ret;}

function separarCampos($texto){
	global $arrDados;
	$texto=str_replace(chr(10),"",$texto);
	$arr=explode(chr(13),$texto);print_r($arr);echo "<br>";
	$str_json="{";
	$detalhe=0;
	foreach($arr as $item){
		$str="";
		foreach($arrDados as $dado){
			$tam=strlen($dado[0]);
			if(substr($item,0,$tam)==$dado[0]){
				if($dado[0]!=''){
					if(strpos($dado[1],'_##')>0){
						$dado[1]=str_replace('_##',('_'.(++$detalhe)),$dado[1]);
					}else
					if(strpos($dado[1],'_#')>0){
						$dado[1]=str_replace('_#',"_$detalhe",$dado[1]);
					}
				}
				if($item!='')$str="{'".$dado[1]."'=>'".substr($item,($tam))."'";
				break;
			}
		}
		if($str!='')$str_json.="$str},";
	}
	return "$str_json}";
}

?> 
