<?php
/** @var array $cashPayment */
/** @var array $noCashPayment*/
/** @var string $type */
//
//var_dump(array_values($cashPayment)[0]);
//var_dump($noCashPayment);

?>
<div class="container">
    <form action="" method="post" enctype="multipart/form-data" class="d-flex gap-3 mt-3" >
        <div>
            <select class="form-select" aria-label="" name="diagramType">
                <option value="bar">Bar</option>
                <option value="line">Line</option>
                <option value="doughnut" >Doughnut</option>
                <option value="polarArea" >PolarArea</option>
            </select>
        </div>

        <input type="submit" class="btn btn-success" value="Знайти">
    </form>
    <div class="container">
        <div class="justify-content-center mt-3">
            <div style="width:900px; height: 500px;" class="text-center mx-auto">
                <canvas id="myChart" style="display: block; margin: 0 auto;width: 100%"></canvas>
            </div>
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
    const data = {
        labels:["<?=key($cashPayment)?>","<?=key($noCashPayment)?>"],
        datasets:[
            {
                label:"",
                backgroundColor:[
                    '#fc1254',
                    '#fc8b12',
                ],
                borderColor: 'rgb(21,115,71)',
                hoverOffset:4,
                data:[<?=array_values($cashPayment)[0]?>,<?=array_values($noCashPayment)[0]?>],
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
            },
            scales: !displayLegend? {y:{max:100,}}:null
        }
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        conf
    );

</script>