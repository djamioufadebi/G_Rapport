<link href="{{ asset('css/style-table.css') }}" rel="stylesheet">

<div class="container mt-5">
  <!-- Informations de la société et son logo -->
  <div class="row mb-4">
    <div class="col-md-6">
      <!-- Insérez le logo de la société ici -->
      <img src="{{ asset('images/innov2b.jpg')}}" alt="Logo de la société" class="img-fluid" width="100" height="auto"
        srcset="">

    </div>
    <div class="col-md-6 text-center">
      <!-- Nom de la société -->
      <h3>INNOVATION BULDING BUSINESS </h3>
    </div>
  </div>

  <!-- Tableau d'informations des users -->
  <div class="row">
    <div class="col-md-12">
      <table class="table">
        <thead>
          <tr>
            <th colspan="2">
              <div class="bg-success text-white p-2">
                Informations sur l'utilisateur : {{ $users->nom }} {{ $users->prenom }}
              </div>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">Nom </th>
            <td>
              {{ $users->nom }}
              <!-- nom du demandeur -->
            </td>
          </tr>
          <tr>
            <th scope="row">Prenom </th>
            <td>
              {{ $users->prenom }}
              <!-- nom du demandeur -->
            </td>
          </tr>
          <tr>
            <th scope="row">Contact</th>
            <td>
              <p> {{ $users->contact }}</p>
            </td>
          </tr>
          <tr>
            <th scope="row">E-mail</th>
            <td>
              <p>{{ $users->email}}</p>
            </td>
          </tr>
          <tr>
            <th scope="row">Date d'enregistrement</th>
            <td>
              <p class="card-text">Date : {{ $users->created_at->format('Y-m-d') }}</p>
              <p class="card-text">Heure : {{ $users->created_at->format('H:i') }}</p>
            </td>
          </tr>
          <tr>
            <th scope="row">Profil</th>
            <td>
              <p>{{ $users->id_profil}}</p>
              <p>
                <!-- nom du profil à mettre -->
              </p>
              <p>
                <button type="submit" data-bs-toggle="modal" data-bs-target="#confirmProfilModal{{ $users->id }}"
                  class="btn btn-sm btn-success">Changer son profil
                </button>
              </p>

              <!-- Modal pour l'attribution de profil -->
              <!-- La Modal -->
              <div wire:ignore class="modal fade" id="confirmProfilModal{{ $users->id }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <!-- Contenu du modal -->
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Attribuer un profil à l'utilisateur {{ $users->nom }} {{ $users->prenom }}
                      </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <br>
                        <div class="text-center">
                          <label class="font-weight-bold d-block">Sélectionnez un profil :</label>
                        </div>
                        <br>
                        <br>
                        <select class="form-control" name="id_profil" wire:model="selectedProfilId">
                          @foreach ($listeProfil as $item)
                          <option value="{{$item->id}}">{{$item->nom}}</option>
                          @endforeach
                        </select>
                        <br>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <a href="{{ route('users.show', $users->id) }}">
                        <button type="button" class="btn btn-danger">Annuler</button>
                      </a>

                      <!-- le wire:click est à mettre -->
                      <button wire:click="confirmSaveIdProfil({{$users->id}})"
                        class="btn btn-primary">Enregistrer</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Fin du modal -->

            </td>
          </tr>



        </tbody>
      </table>
    </div>
  </div>
</div>