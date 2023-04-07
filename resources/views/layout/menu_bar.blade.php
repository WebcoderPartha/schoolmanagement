<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Dashboard</span>
                <div class="badge badge-danger">new</div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#role" aria-expanded="false" aria-controls="role">
                <i class="typcn typcn-document-text menu-icon"></i>
                <span class="menu-title">Role Section</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="role">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('role.create') }}">Add Role</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('role.index') }}">All Role</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#user" aria-expanded="false" aria-controls="user">
                <i class="typcn typcn-film menu-icon"></i>
                <span class="menu-title">Manage User</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="user">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.create') }}">Add User</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.index') }}">All User</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#setups" aria-expanded="false" aria-controls="setups">
                <i class="typcn typcn-chart-pie-outline menu-icon"></i>
                <span class="menu-title">Manage Setup</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="setups">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('student.class.view') }}">Student Classes</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('student.year.view') }}">Student Year</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('student.group.view') }}">Student Group</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('student.shift.view') }}">Student Shift</a></li>
{{--                    <li class="nav-item"> <a class="nav-link" href="{{ route('student.fcategory.view') }}">Fee Category</a></li>--}}
{{--                    <li class="nav-item"> <a class="nav-link" href="{{ route('student.fcamount.view') }}">Fee Amount</a></li>--}}
                    <li class="nav-item"> <a class="nav-link" href="{{ route('exam_type.view') }}">Exam Type</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('school_subject.view') }}">School Subject</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('assign_subject.view') }}">Assign Subject</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('designation.view') }}">Designation</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#managefees" aria-expanded="false" aria-controls="managefees">
                <i class="typcn typcn-chart-pie-outline menu-icon"></i>
                <span class="menu-title">Manage Fee</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="managefees">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('regi.fees.view') }}">Registration Fee</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('monthly.fees.view') }}">Monthly Fee</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('exam.fees.view') }}">Exam Fee</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#students" aria-expanded="false" aria-controls="students">
                <i class="typcn typcn-chart-pie-outline menu-icon"></i>
                <span class="menu-title">Manage Student</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="students">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('student.all.view') }}">Student Registration</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('role.generate.view') }}">Roll Generate</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('payRegistration_view') }}">Pay Registration Fee</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('payMonthlyFee_view') }}">Pay Monthly Fee</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('payExamFee_view') }}">Pay Exam Fee</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Employee" aria-expanded="false" aria-controls="Employee">
                <i class="typcn typcn-chart-pie-outline menu-icon"></i>
                <span class="menu-title">Manage Employee</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Employee">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('employees.view') }}">Employee Registration</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('employees.salary_view') }}">Employee Salary</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('employees.leave_view') }}">Employee Leave</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('employees.attendance_view') }}">Employee Attendance</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('employees.monthlySalary_view') }}">Monthly Salary</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#manage_mark" aria-expanded="false" aria-controls="manage_mark">
                <i class="typcn typcn-chart-pie-outline menu-icon"></i>
                <span class="menu-title">Manage Marks</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="manage_mark">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('mark.view') }}">Marks Entry</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('marks.edit') }}">Marks Edit</a></li>
                </ul>
            </div>
        </li>

    </ul>
</nav>
