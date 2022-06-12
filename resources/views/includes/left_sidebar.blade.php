<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <li><a href="#" class="" aria-expanded="false">
                    <i class="fa fa-dashboard"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a href="{{ route('eventList') }}" class="ai-icon" aria-expanded="false">
                    <i class="fa fa fa-calendar-o fa-lg"></i>
                    <span class="nav-text">Events</span>
                </a>
            </li>
            <li><a class="" href="{{ route('userTypes') }}" aria-expanded="false">
                    <i class="fa fa-user-secret"></i>
                    <span class="nav-text">User Type</span>
                </a>
            </li>
            <li><a class=" " href="{{ route('attendeeList') }}" aria-expanded="false">
                    <i class="fa fa-user-circle-o"></i>
                    <span class="nav-text">Attendee</span>
                </a>
            </li>
            <li><a class=" " href="{{ route('templateList') }}" aria-expanded="false">
                    <i class="fa fa-circle-o-notch"></i>
                    <span class="nav-text">Templates</span>
                </a>
            </li>
            <li><a class=" " href="{{ route('print_attendee') }}" aria-expanded="false">
                    <i class="fa fa-building-o"></i>
                    <span class="nav-text">Print Stations</span>
                </a>
            </li>
            <li><a class=" " href="{{ route('print_report') }}" aria-expanded="false">
                    <i class="fa fa-file-picture-o"></i>
                    <span class="nav-text">Print Report</span>
                </a>
            </li>
        </ul>
        <div class="copyright">
            <p><strong>Registro Asia Admin Dashboard</strong> © 2021 All Rights Reserved</p>
            <p class="fs-12">Made with <span class="heart"></span> by Registro Asia</p>
        </div>
    </div>
</div>