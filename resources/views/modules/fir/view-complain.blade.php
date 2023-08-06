<div class="container">
    <h1>Complain Details</h1>
    <hr>

    <div class="row">
        <div class="col-md-6">
            <h2>Complain Information</h2>
            <ul>
                <li><strong>Complain Number:</strong> {{ $complain->complain_number }}</li>
                <li><strong>Incident Date:</strong> {{ $complain->incident_date }}</li>
                <li><strong>Reported At:</strong> {{ $complain->reported_at }}</li>
                <li><strong>Complainant:</strong> {{ $complain->getComplainBy->name }}</li>
                <li><strong>Incident Type:</strong> {{ $complain->getIncidentType->name }}</li>
                <li><strong>Status:</strong> {{ $complain->getStatus->name }}</li>
            </ul>
        </div>

        <div class="col-md-6">
            <h2>Complain Details</h2>
            <p>{{ $complain->complain_details }}</p>
        </div>
    </div>
</div>
