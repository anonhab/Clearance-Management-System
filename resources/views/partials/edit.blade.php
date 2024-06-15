   <!-- Add Modal HTML -->
    <div id="addEmployeeModal" class="modal  fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" method="POST">
                    @csrf <!-- CSRF protection -->
                    <div class="modal-header">
                        <h4 class="modal-title">New request</h4>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="worker_name">ስም</label>
                            <input type="text" id="worker_name" name="worker_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="work_name">የሥራ መደቡ መጠሪያ</label>
                            <input type="text" id="work_name" name="work_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="file_no">ፋይል ቁጥር</label>
                            <input type="number" id="file_no" name="file_no" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="allow_name">የፈቀደው ኃላፊ ሥም</label>
                            <input type="text" id="allow_name" readonly value="ኃላፊ" name="allow_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="work_space">የሥራ ክፍል</label>
                            <select id="work_space" name="work_space" class="form-control" required>
                                <option value="work_id_1">1 የመምህሩ የቅርብ ኃላፊ</option>
                                <option value="work_id_2">2 የመደበኛ በጀት ሳብ ዋና ክፍል</option>
                                <option value="work_id_3">3 የኘሮጀክትና የውስጥ ገቢ ሂሳብ ዋና ክፍል</option>
                                <option value="work_id_4">4 የንብረትምዝገባና ቁጥጥር ሠራተኛ</option>
                                <option value="work_id_5">5 ቤተመጻህፍት</option>
                                <option value="work_id_6">6 መጻህፍት ግምጃ ቤት</option>
                                <option value="work_id_7">7 የስፖርት አካዳሚ</option>
                                <option value="work_id_8">8 የስፖርትና መዝናኛ</option>
                                <option value="work_id_9">9 ብድርና ቁጠባ ማህበር</option>
                                <option value="work_id_10">10 ሥነ-ምግባር መከታተ ያክፍል</option>
                                <option value="work_id_11">11 ሬጅስትራር</option>
                                <option value="work_id_12">12 ጥገና ክፍል</option>
                                <option value="work_id_13">13 የሕንፃዎች እና የመኖሪያ ቤቶች ማስተባበሪያ ጽ/ቤት</option>
                                <option value="work_id_14">14 የገቢዎች ማመንጫ ዳይሬክቶሬት</option>
                                <option value="work_id_15">15 የእርቀት እና ተከታታይ ትምህርት ማስተባበሪያ ጽ/ቤት</option>
                                <option value="work_id_16">16 ቢሮ አገልግሎት</option>
                                <option value="work_id_17">17 መምህራን ማህበር</option>
                                <option value="work_id_18">18 የምርምር እና ማህበረሰብ አገልግሎት</option>
                                <option value="work_id_19">19 የሰው ኃብት ልማት ቡድን</option>
                                <option value="work_id_20">20 ሪከርድና ማህደር ክፍል</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="leaving_case">የሚለቅበት ምክንያት</label> 
                            <input type="text" id="leaving_case" name="leaving_case" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="work_dep">የሥራ ክፍል</label>
                            <input type="text" id="work_dep" name="work_dep" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-success" value="Request">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal  ">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteEmployeeForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Employee</h4>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete the record with ID <span id="delete-employee-id"></span>?
                        </p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>