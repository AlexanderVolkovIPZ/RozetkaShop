<?php
/** @var array $categoriesMarks*/
/** @var string $type */
?>


<div class="container">
    <form action="" method="post" enctype="multipart/form-data" class="d-flex gap-3 mt-3" >
<!--        <div>-->
<!--            <select class="form-select statistics_days_select" aria-label="" name="month">-->
<!--                <option selected disabled value="default">Категорія</option>-->
<!--                --><?php //foreach ($categoriesArray as $key=>$value):?>
<!--                    <option value="--><?//=$key?><!--">--><?//=$value?><!--</option>-->
<!--                --><?php //endforeach;?>
<!--            </select>-->
<!--        </div>-->
        <div>
            <select class="form-select" aria-label="" name="diagramType">
                <option selected disabled value="default">Тип</option>
                <option value="bar">Bar</option>
                <option value="line">Line</option>
                <option value="doughnut" >Doughnut</option>
                <option value="polarArea" >PolarArea</option>
            </select>
        </div>

        <input type="submit" class="btn btn-success" value="Знайти">
    </form>
    <div class="justify-content-center mt-3">
        <div style="width:900px; height: 500px;" class="text-center mx-auto">
            <canvas id="myChart" style="display: block; margin: 0 auto;width: 100%"></canvas>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart');
    let displayLegend = true;
    let typeChart = `<?=$type?>`;
    if(typeChart==='bar'||typeChart==='line'){
        displayLegend = false;
    }
    let labelUse = [];
    <?php foreach ($categoriesMarks as $key=>$value):?>
    labelUse.push(`<?=$key?>`)
    <?php endforeach;?>
    const data = {
        labels:labelUse,
        datasets:[
           {
               label:"Рейтинг за категорією",
               backgroundColor:[
                   '#fc1254',
                   '#fc8b12',
                   '#e5fc12',
                   '#64fc12',
                   '#12fcc5',
                   '#1283fc',
                   '#5812fc',
                    '#be12fc',
                    '#fc12e5',
                    '#d4d4d4',
                    '#c87b91',
                    '#312345'
                ],
                borderColor: 'rgb(21,115,71)',
                hoverOffset:4,
                data:[<?=implode(',',array_values($categoriesMarks))?>],
            },
        ]
    };

    const conf={
        type:'<?=$type?>',
       data:data,
       options:{
           indexAxis:'x',
           plugins:{
               legend:displayLegend,
               position:'bottom'
           },
           title:{
               display:true,
               text:'Some title'
           }
       }
   };

   const myChart = new Chart(
       document.getElementById('myChart'),
       conf
   );

</script>
