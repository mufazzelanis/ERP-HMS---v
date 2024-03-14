<style>

        @media print {
            .btn {
                display: none;
            }

            .footer {
                display: none;
            }

            .main-footer {
                display: none;
            }
             tbody {
             border: 1px solid lightgray;
             }            
        }

    .order-head {
        margin-bottom: 30px;
    }

    table, td {
        border: 1px solid lightgray;
    }

    #cmbUom {
        width: 100%;
    }

    element.style {
        width: 200px;
    }

    h2#invoice {
        padding: 50px 15px;
        margin-left: 100px;
    }

    .table {
        padding: 0.75rem;
        vertical-align: top;
        border: none !important;
    }

    .shadow-lg {
    border-radius: 10px;
    }

    
</style>

<div class="section content pt-2">
    <div class="row">
        <div class="col-12 p-3">
            <div class="shadow-lg" style="background-color: #dadada">
                <div class="row">
                    <div class="col-sm-4">
                        <img style="width: 140px;" class="mw-100 mb-2" src="asset/dist/image/hospital logo.png" alt="" />
                    </div>
                    <div class="col-sm-4 text-center">
                        <h2 class="m-0"><strong>HOSPITAL MANAGEMENT SYSTEM</strong></h2>
                        <address>
                            <strong>Bangladesh,</strong> Dhaka<br />
                            <strong>Mobile:</strong> 01518303867<br />
                            <strong>Email:</strong> info@gmail.com<br />
                        </address>
                    </div>
                    <div class="col-sm-4">
                        <h2 class="d-flex justify-content-center" id="invoice"><strong>Invoice</strong></h2>
                    </div>
                </div>
                <table class="table">
                    <tr>
                        <td><i class="fas fa-calendar"></i><strong> Date:</strong></td>
                        <td> <input type="date" id="Date" value="<?php echo date("Y-m-d") ?>"></td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-user-injured"></i> <strong>Patient</strong></td>
                        <td>
                            <?php
                            echo Patient::html_select("cmbPatient");
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-user-md"></i> <strong>Refd By Doctor</strong></td>
                        <td>
                            <?php
                            echo Doctor::html_select("cmbDoctors");
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <table class="table">
                                <tr>
                                    <td><i class="fas fa-check"></i> <strong>Select Item</strong></td>
                                    <td><i class="fas fa-money-bill"></i> <strong>Price</strong></td>
                                    <td><strong>Action</strong></td>
                                </tr>
                                <tr>
                                    <td style="width:250px;">
                                        <?php
                                        echo LabeTest::html_select("cmbLabeTest");
                                        ?>
                                    </td>
                                    <td><input type="text" id="price" /></td>
                                    <td>
                                        <!-- <input type="button" id="addtest" class="btn btn-success btn-plus shadow"><i class="fas fa-plus"></i> -->
                                        <button type="button" id="addtest" class="btn btn-success btn-plus shadow"><i class="fas fa-plus"></i></button>
                                    </td>
                                    
                                </tr>
                                <tbody id="bill">

                                </tbody>
                                <tr>
                                    <td colspan="2" style="text-align:right;font-weight:bold">Discount</td>
                                    <td><input class="cal" type="text" id="discount" /></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align:right;font-weight:bold">Total</td>
                                    <td><input type="text" readonly id="total" /></td>
                                </tr>
                                <!-- <tr>
                                    <td colspan="2" style="text-align:right;font-weight:bold">Advance</td>
                                    <td><input class="cal" type="text" id="advance" /></td>
                                </tr> -->
                                <!-- <tr>
                                    <td colspan="2" style="text-align:right;font-weight:bold">Due</td>
                                    <td><input type="text" readonly id="due" /></td>
                                </tr> -->
                                <tr>
                                    <td colspan="2" style="text-align:right;font-weight:bold">Remark</td>
                                    <td><textarea id="remark"></textarea></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align:right;font-weight:bold"></td>
                                    <td><input type="button" id="save" value="Save" class="btn btn-primary" /></td>
                                    
                                </tr>
                                
                            </table>
                            <button type="button" id="btnPrint" onclick="window.print()" class="btn btn-outline-dark"><i class="fas fa-print"></i> Print</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
      
    $(function(){

        var details=[];

                $("#save").on("click",function(){               
                
                let patient_id=$("#cmbPatient").val();
                let doctor_id=$("#cmbDoctors").val();
                let item=$("#cmbLabeTest").val();
                let discount=$("#discount").val();
                let total=$("#total").val();
                let remark=$("#remark").val();
                let invoice_date=$("#cmbInvoice").val();
                

                let InvoiceDetail = details;

                $.ajax({
                    type:"post",
                    url:"api/invoice/save",
                    data:{
                        "patient_id":patient_id,
                        "doctor_id":doctor_id,
                        "item":item,
                        "discount":discount,
                        "total":total,
                        "remark":remark,
                        "invoice_date":invoice_date,
                        "InvoiceDetail":InvoiceDetail
                    },
                    success:function(res){
                    console.log(res);
                    }
                });

            });

        //Show Service other information
        $("#cmbLabeTest").on("change", function () {
            $.ajax({
                url: "api/LabeTest/find",
                type: "POST",
                data: {
                    id: $(this).val(),
                },
                success: function (res) {
                    let data = JSON.parse(res);
                    let labetest = data.labetest;
                    console.log(labetest);
                    $("#price").val(labetest.price);
                },
            });
        }); //


        //Add Services
        $("#addtest").on("click", function () {
            let labe_test_id = $("#cmbLabeTest").val();
            let test_name = $("#cmbLabeTest option:selected").text();
            let price = $("#price").val();
            let date = $("#Date").val();

            details.push({ labe_test_id: labe_test_id, test_name: test_name, price: price, date:date });
            console.log(details)
            printDetails(details);
            updateTotalAmount();
        });

        //Print Details Function
        function printDetails(details) {
            $("#bill").html("");
            details.forEach(function (item) {
                $("#bill").append(`
                <tr>
                 <td class="w-50">${item.test_name}</td>
                 <td class="w-25">
                   <input type="text" value="${item.price}" />
                 </td>
                 <td class="w-30">
                 
                   <button  type="button" class="btn btn-danger shadow" data-id="${item.labe_test_id}"><i class="fas fa-trash-alt"></i></button>
                 </td>
                </tr>
               `);
            });
        } //end printDetails

        //Delete Service Event
        $("body").on("click", ".btn", function () {
            let id = $(this).data("id");

            details = details.filter((f) => {
                return f.labe_test_id != id;
            });

            printDetails(details);
            updateTotalAmount();
        }); //end Event

        //Price Update Event
        $(".cal").on("input", function () {
            updateTotalAmount();
        });//end Event

        //Total Calculation Function
        function updateTotalAmount() {
            let total = 0;

            details.forEach(function (item) {
                total += parseFloat(item.price);
            });

            let discount = parseFloat($("#discount").val()) || 0;
            total -= discount;

            $("#total").val(total.toFixed());

            let paid_total = parseFloat($("#paid_total").val()) || 0;
            let due = total - paid_total;
            $("#due").val(due.toFixed());
        }//end Function

    });

    // $("#btnPrint").on("click", function () {
    //     window.print();
    // });

</script>