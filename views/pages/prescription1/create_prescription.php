<style>
    .table td, .table th {
        padding: 0.75rem;
        vertical-align: top;
        border: none !important;
    }

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
    }
</style>

<section class="content pt-3">
    <div style="background-color:#dadada" class="container-fluid p-3 border rounded">
        <div class="row">
            <div class="col-sm-4">
                <img style="width: 140px;" class="mw-100 mb-2" src="asset/dist/image/hospital logo.png" alt="" />
            </div>
            <div class="col-sm-4 text-center">
                <h2 class="m-0">HOSPITAL MANAGEMENT SYSTEM</h2>
                <address>
                    <strong>Bangladesh,</strong> Dhaka<br />
                    <strong>Mobile:</strong> 01518303867<br />
                    <strong>Email:</strong> info@gmail.com<br />
                </address>
            </div>
            <div class="col-sm-4"></div>
        </div>

        <table class="table myth">
            <div class="row">
                <tr>
                    <th style="width: 33%;">
                        <i class="fas fa-user-md"></i> Doctor Name:<br />
                        <?php
                        echo Doctor::html_select("cmbDoctors");
                        ?>
                        <p id="doctor-info"></p>
                    </th>
                    <th style="width: 33%;">
                        <i class="fas fa-user-injured"></i> Patient:<br />
                        <?php
                        echo Patient::html_select("cmbPatient");
                        ?>
                        <p id="patient-info"></p>
                    </th>
                    <th style="width: 33%;">
                        <div class="date mb-2">
                            Date:<br>
                            <input id="prescription_date" type="date" value="<?php echo date("d-m-Y") ?>">
                        </div>
                        <div class="patient-id">
                            Prescription ID:<input id="prescription_id" type="text" value= "<?php Prescription::get_last_id()?>" size="2">
                        </div>
                    </th>
                </tr>
            </div>
        </table>

        <div class="row mt-3">
            <!-- Left -->
            <div class="col-md-7">
                <div class="row mt-3 custom-border pe-5">
                    <h3 class="text-center"><i class="fas fa-pills"></i><strong> Medicines</strong></h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th><i class="fa fa-medkit"></i> MEDICINE</th>
                                <th><i class="fas fa-pills"></i> Dose</th>
                                <th>DAYS</th>
                                <th>Suggestion</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>
                                <?php
                                    echo Medicine::html_select("cmbMedicines");
                                ?>
                            </td>
                            <td>
                                <select id="dose" style="width: 100%;">
                                    <option value="0-0-1">0-0-1</option>
                                    <option value="1-0-0">1-0-0</option>
                                    <option value="1-0-0">1-0-0</option>
                                    <option value="1-1-0">1-1-0</option>
                                    <option value="1-0-1">1-0-1</option>
                                    <option value="1-1-1">1-1-1</option>
                                </select>
                            </td>
                            <td>
                                <select id="day" style="width: 100%;">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">22</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                </select>
                            </td>
                            <td>
                                <input id="instruction" class="form-control" type="text" placeholder="Before Food" />
                            </td>
                            <td>
                                <button id="addMedicine" class="btn btn-success btn-plus shadow"><i class="fas fa-plus"></i></button>
                            </td>
                        </tr>
                        <tbody id="medicine">
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Right -->
            <div class="col-md-4 custom-border">
                <label for="c/c" class="form-label">History</label>
                <textarea class="form-control" id="history" rows="6"></textarea>
                
                <label for="rf" class="form-label mt-3">Note</label>
                <textarea class="form-control" id="note" rows="4"></textarea>

                <label for="investigation" class="form-label">Advice</label>
                <textarea class="form-control" id="advice" rows="3"></textarea>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <button type="button" id="btnPrint" class="btn btn-outline-dark"><i class="fas fa-print"></i> Print</button>
                <button type="button" id="save" class="btn btn-primary float-right"><i class="fas fa-prescription"></i> Process Prescription</button>
            </div>
        </div>
    </div>
</section>

<script>
    $(function () {

        var insDetails = [];

        $("#save").on("click",function(){               
        
            let patient_id=$("#cmbPatient").val();
            let doctor_id=$("#cmbDoctors").val();
            let appointment_id=$("#cmbAppointment").val();
            let prescription_date=$("#prescription_date").val();
            let history=$("#history").val();
            let advice=$("#advice").val();
            let note=$("#note").val();

            let insDetails=insDetails;
     

            //    let prescriptionDetails={
            //     prescription_date:prescription_date,
            //     history:history,
            //     advice:advice,
            //     note:note,
            //   }


            $.ajax({
                type:"post",
                url:"api/prescription/save",
                data:{
                    "patient_id":patient_id,
                    "doctor_id":doctor_id,
                    "appointment_id":appointment_id,
                    "prescription_date":prescription_date,
                    "history":history,
                    "note":note,
                    "insDetails":insDetails
                },
                success:function(res){
                console.log(res);
                }
            });
   
        });

       $("#cmbDoctors").on("change", function () {
            $.ajax({
                url: "api/doctor/find",
                type: "GET",
                data: {
                    id: $(this).val(),
                },
                success: function (res) {
                    let data = JSON.parse(res);
                    console.log(data);
                    let doctor = data.doctor;

                    $("#doctor-info").html(`
                <p class="m-0"><b>Name:</b> ${doctor.name}</p>
                <p class="m-0"><b>Designation:</b> ${doctor.designation}</p>
                <p class="m-0"><b>Email:</b> ${doctor.email}</p>
            `);
                },
            });
        });


        $("#cmbPatient").on("change", function () {
            $.ajax({
                url: "api/patient/find",
                type: "GET",
                data: {
                    id: $(this).val(),
                },
                success: function (res) {
                    let data = JSON.parse(res);
                    console.log(data);
                    let patient = data.patient;

                    $("#patient-info").html(`
                <p class="m-0"><b>Name:</b> ${patient.name}</p>
                <p class="m-0"><b>Number:</b> ${patient.contact_number}</p>
                <p class="m-0"><b>DOB:</b> ${patient.dob}</p>
            `);
                },
            });
        });


        $("#addMedicine").on("click", function () {
            let medicine_id = $("#cmbMedicines").val();
            let medicine_name = $("#cmbMedicines option:selected").text();
            let dose = $("#dose").val();
            let day = $("#day").val();
            let instruction = $("#instruction").val();

            insDetails.push({
                medicine_id: medicine_id,
                medicine_name: medicine_name,
                dose: dose,
                day: day,
                instruction: instruction
            });

            //console.log(insDetails);
            printDetails(insDetails);
        });


        //Print Details Function
        function printDetails(insDetails) {
            $("#medicine").html("");
            insDetails.forEach(function (item) {
                $("#medicine").append(`
                <tr>
                  <td>${item.medicine_name}</td>
                  <td>${item.dose}</td>
                  <td>${item.day}</td>
                  <td>${item.instruction}</td>
                  <td><button class="btn-del btn btn-danger shadow" data-id="${item.medicine_id}"><i class="fas fa-trash-alt"></i></button></td>
                </tr>
                `);
            });
        } //end printDetails


        //Delete Service Event
        $("body").on("click", ".btn-del", function () {
            let id = $(this).data("id");

            insDetails = insDetails.filter((f) => {
                return f.medicine_id != id;
            });

            printDetails(insDetails);
        }); //end Event

    });

    $("#btnPrint").on("click", function () {
        window.print();
    });



</script>