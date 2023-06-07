<?php
/** @var array $years */
/** @var array $date */
/** @var string $type */
/** @var string $year */

?>

<div class="container">
    <form action="" method="post" enctype="multipart/form-data" class="d-flex gap-3 mt-3" >
        <div>
            <select class="form-select" aria-label="" name="year">
                <option selected disabled value="default">Рік</option>
                <?php foreach ($years as $key=>$value):?>
                    <option value="<?=$value['year']?>"
                    <?php if ($value['year']==$year):?>
                        <?="selected"?>
                    <?endif;?>
                    ><?=$value['year']?></option>
                <?php endforeach;?>
            </select>
        </div>

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
    console.log(displayLegend)
    console.log(typeChart)
    const labels = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    let labelUse = [];
    <?php foreach (array_keys($date) as $key=>$value):?>
        labelUse.push(labels[<?=$value?>])
    <?php endforeach;?>
    const data = {
        labels:labelUse,
        datasets:[
            {
                label:"Обіг",
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
                data:[<?=implode(',',array_values($date))?>],

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
                display:false,
                text:"SomeText",
                position: 'right',
                fontsize: 16
            }
        }
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        conf
    );

</script>