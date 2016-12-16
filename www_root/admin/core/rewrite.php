<?php

class rewrite{
    
   static function getRewrite($name = "", $table = "", $id = "-"){

       $str = $name;

       $arrFrom = explode(" ", "Ě É Ë ě é ë Š š Č č Ř ř Ž ž Ý ý Á Ä á ä Í í Ů Ú Ü ů ú ü ň Ň Ľ ľ ĺ Ť ť Ô Ö Ó ô ö ó");
       $arrTo = explode(" ", "e e e e e e s s c c r r z z y y a a a a i i u u u u u u n n l l l t t o o o o o o");

       foreach ($arrFrom as $key => $val)
           $tr[$val] = $arrTo[$key];

       $str = strtr($str, $tr);

       $str = strtr($str, array(' ' => '-'));

       $str = StrTr($str, "/", "-");

       $str = @ereg_Replace("[^0-9a-zA-Z-]", "", $str);

       $str = @ereg_Replace("\-{2,}", "-", $str);

       $str = trim($str, '-');

       $str = strtolower($str);

       $out = $str;
       /*	// nejprve img tagy //
           if( @strpos( $out, "<" ) > 0 ) $out = substr( $out, 0, strpos( $out, "<" ) );

           // nahradime mezery pomlckou //
           $out = StrTr( $out, " ", "-" );

           // ted nahradime vsechny divne znaky ceske znaky //
           $arrFROM = explode( " ", "Ě É Ë ě é ë Š š Č č Ď ď Ř ř Ž ž Ý ý Á Ä á ä Í í Ů Ú Ü ů ú ü ň Ň Ľ ľ ĺ Ť ť Ô Ö Ó ô ö ó" );
           $arrTO =   explode( " ", "E E E e e e S s C c D d R r Z z Y y A A a a I i U U U u u u n N L l l T t O O O o o o" );
          for( $i = 0; $i < count( $arrFROM ); $i++ )
          {
              $out = str_replace( $arrFROM[$i], $arrTO[$i], $out );

             }

           // a rustina //
           $arrRuFromB = explode( ",", "А,Б,В,Г,Д,Е,Ё,Ж,З,И,Й,К,Л,М,Н,О,П,Р,С,Т,У,Ф,Х,Ц,Ч,Ш,Щ,Ы,Э,Ю,Я" );
           $arrRuFromS = explode( ",", "а,б,в,г,д,е,ё,ж,з,и,й,к,л,м,н,о,п,р,с,т,у,ф,х,ц,ч,ш,щ,ы,э,ю,я" );
           $arrRuToB   = explode( ",", "A,B,V,G,D,E,E,Z,Z,I,J,K,L,M,N,O,P,R,S,T,U,F,H,C,C,S,SC,Y,E,JU,JA" );
             $arrRuToS   = explode( ",", "a,b,v,g,d,e,e,z,z,i,j,k,l,m,n,o,p,r,s,t,u,f,h,c,c,s,sc,y,e,ju,ja" );
           for( $i = 0; $i < count( $arrRuFromB ); $i++ )
           {
               $out = StrTr( $out, $arrRuFromB[$i], $arrRuToB[$i] );
               $out = StrTr( $out, $arrRuFromS[$i], $arrRuToS[$i] );
               //$out = preg_replace( $arrRuFromB[$i], $arrRuToB[$i], $out );
               //$out = preg_replace( $arrRuFromS[$i], $arrRuToS[$i], $out );
             }

           // ted nahradime mezery nicim //
           $out = StrTr( $out, " ", "-" );
           $out = StrTr( $out, ")", "-" );
           $out = StrTr( $out, "(", "-" );

           // ted nahradime lomitka pomlckou //
           $out = StrTr( $out, "/", "-" );

           // odstranime vsechny znaky mimo abecedu, cisla a pomlcku //
           $out = preg_replace( "[^0-9a-zA-Z-]", "", $out );

           // no a pokud mame vic pomlcek za sebou nahradime //
           $out = preg_replace( "/\-{2,100}/", "-", $out );

           // a jeste nahradime pomlcky na zacatku nebo na konci //
           $out = preg_replace( "/^\-/", "", $out );
           $out = preg_replace( "/\-$/", "", $out );
       */




		// zjistime nulovou velikost //
		if( strlen( $out ) == 0 ) $out = "none-".date( "s" );
		$out = strtolower( $out );
               
                
                if ($table != ""){
                    if ($id == "-"){
                        $query = "select rew from $table where rew = '$out'";
                        $data = new sql($query);
                        foreach ($data as $zaznam) {
                            $out = $out."-".date( "s" );
                        }
                    }else{
                        $query = "select rew from $table where rew = '$out' and id <> $id";
                        $data = new sql($query);
                        foreach ($data as $zaznam) {
                            $out = $out."-".$id;
                        }
                    }
                }              
                
		return $out;
    }
}