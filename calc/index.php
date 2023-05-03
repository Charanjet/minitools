<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calculator With JavaScript</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <script src="../assets/js/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 offset-lg-3 offset-md-3">
                <div class="calc-wrapper text-center" >
                    <div class="output-screen">
                    </div>
                    <div class="inputs-wrapper">
                        <button name="one" value="1">1</button>
                        <button name="two" value="2">2</button>
                        <button name="three" value="3">3</button>
                        <button name="four" value="4">4</button>
                        <button name="five" value="5">5</button>
                        <button name="six" value="6">6</button>
                        <button name="seven" value="7">7</button>
                        <button name="eight" value="8">8</button>
                        <button name="nine" value="9">9</button>
                        <button name="zero" value="0">0</button>
                        <input type="hidden" name="input1" id="input1" value="">
                        <input type="hidden" name="input2" id="input2" value="">
                    </div>
                    <div class="operations-wrapper">
                        <button value="add">+</button>
                        <button value="divide">/</button>
                        <button value="multiply">*</button>
                        <button value="subtract">-</button>
                        <button value="submit">=</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var inp1,inp2,result,operation;
        inp1 = true;
        inp2 = false;
        result = '';
        //input 1
        //input 2
        function setInput(target='',value='',isresult=false){
            let outputscreen = $('.output-screen');
            if (isresult){
                $(outputscreen).html(value);
                $('#input1').val(value);
                $('#input2').val('');

            } else{
                let finalValue = getFinalValue(target,value);
                $(outputscreen).html(finalValue);
                $('#'+target).val(Number(finalValue));
            }
        }
        function getFinalValue(target,value){
            let previousVal = String($('#'+target).val());
            return previousVal+= String(value);

        }
        $('.inputs-wrapper button').on('click',function (e) {
            let input = e.currentTarget.value;
            if (inp1){
                //store input value in input1
                setInput('input1',input);
            }
            if (inp2){
                //store input value in input2
                setInput('input2',input);
            }
        });
        //operation
        $('.operations-wrapper button').on('click',function (event) {
            let operand = event.currentTarget.value;
            console.log('operand',operand);
            let input1 = Number($('#input1').val());
            let input2 = Number($('#input2').val());

            if (operand=="submit")//button is not == submit
            {
                //validate inp1
                if (input1!='' && input2 !=''){
                    switch (operation) {
                        case 'add':
                            setInput('',input1+input2,true);
                            break;
                        case 'divide':
                            setInput('',input1/input2,true);
                            break;
                        case 'multiply':
                            setInput('',input1*input2,true);
                            break;
                        case 'subtract':
                            setInput('',input1-input2,true);
                            break;
                        case 'default':
                            console.log('no action');

                    }

                }
                //validate inp2 not empty
                //result = inp1 operand inp2
                //show result on screen
            }else{
                //set inp1 false
                inp1 = false;
                //set inp2 true
                inp2 = true;
                //set operand
                operation = operand;
            }

        });
        //result
    </script>
    <style>
        .inputs-wrapper button{
            width: 20px;
            height: 20px;
            background: grey;
            border-radius: 10px;
            padding: 20px;
            color: white;
            margin: 5px;
            text-align: center;
        }
        .output-screen{
            background: #1d2124;
            color: white;
            height: 50px;
            padding: 10px;
            text-align: right;
        }
    </style>
</body>
</html>