
function SumComa()
{



    var pila_sum = new Array();
    var acum_sum = 0;

    this.add = function(str){

        var tmp = str.replace(",",".");

        pila_sum.push(tmp);
    }




    this.print = function(){

        for(var i = 0 ; i < pila_sum.length ; i++)
            console.log(pila_sum[i] + " -> "+ typeof(pila_sum[i]));
    }

    this.getSum = function(){

        for(var i = 0 ; i < pila_sum.length ; i++){

            if(pila_sum[i].length == 0){
                pila_sum[i] = 0;
            }
            acum_sum = parseFloat(acum_sum) + parseFloat( pila_sum[i]);



        }

        acum_sum =  Math.round(acum_sum*100)/100

        acum_sum = acum_sum.toString();
        acum_sum = acum_sum.replace(".",",");





        var rtn = acum_sum;
        acum_sum = 0;

        pila_sum.length = 0;

        return rtn;
    }


    this.divComa = function(num,div){
        var div = div.replace(",",".");
        var num = num.replace(",",".");

        div = parseFloat(div);
        num = parseFloat(num);


        var resultado = num / div;


        resultado = Math.round(resultado*100)/100;


        resultado = resultado.toString();
        resultado = resultado.replace(".",",");


        return resultado;

    }


    this.getMul = function(){

        if(acum_sum == 0 ){
            acum_sum = 1;
        }
        for(var i = 0 ; i < pila_sum.length ; i++){

            if(pila_sum[i].length == 0){
                pila_sum[i] = 0;
            }
            acum_sum = parseFloat(acum_sum) * parseFloat( pila_sum[i]);

        }

        acum_sum =  Math.round(acum_sum*100)/100

        acum_sum = acum_sum.toString();
        acum_sum = acum_sum.replace(".",",");


        var rtn = acum_sum;
        acum_sum = 0;

        pila_sum.length = 0;


        return rtn;
    }



}
