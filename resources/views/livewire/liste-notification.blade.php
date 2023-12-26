<div class="row">
  <div class="col-md-12">
    <div class="card">
      <!-- <div class="card-header">Liste des articles</div> -->
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Titre </th>
              <th scope="col">Contenu</th>
              <th scope="col">Etat</th>
              <th scope="col">Date</th>
            </tr>
          </thead>

          <tbody>

            @foreach ($NotReadNotifications as $notification)
            <tr>
              <td>{{$notification->titre}}</td>
              <td>{{$notification->message}}</td>
              <td>{{$notification->read}}</td>
              <td>{{$notification->created_at}}</td>
          </tbody>
          @endforeach

        </table>

      </div>
    </div>
  </div>
</div>