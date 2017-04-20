import Chart from 'chart.js';

export default{
   template:'<canvas width="600" height="400" id="graph"></canvas>',

   ready(){
     var data ={
       labels: ['sss','aaaa' ,'pppp' ],
       datasets:[
         {
          data:[20,122,40] ,
         }
       ]
     };
     var context = document.querySelector('#graph').getContext('2d');

     new Chart.Line(context,{
       data:data,
     });
   }
}
