@php
$sessionKeys = ['success', 'error', 'warning', 'info']; // Liste des clés de session à vérifier
@endphp

@foreach($sessionKeys as $key)
@if(session()->has($key))
<script>
Swal.fire({
  // Utilisation de la clé de session pour le titre ou la capitalisation de la clé
  title: '{{ session($key . '
    .title ') ?? ucfirst($key) }}',
  text: '{{ session($key . '.message ') }}',
  // Détermination de l'icône en fonction de la clé
  icon: '{{ $key === '
  error ' ? '
  error ' : ($key === '
  warning ' ? '
  warning ' : ($key === '
  info ' ? '
  info ' : '
  success ')) }}',
  confirmButtonText: 'OK'
});
</script>
@endif
@endforeach

@if(session('success'))
<script>
Swal.fire({
  title: 'Ajout profil !',
  text: 'Nouveau profil enregistré',
  icon: 'success',
  confirmButtonText: 'OK'
})
</script>
@endif

@if(session('modify'))
<script>
Swal.fire({
  titl
  e: 'Modification du Profil !',
  text: 'Profil modifié avec succès !',
  icon: 'success',
  confirmButtonText: 'OK'
})
</script>
@endif
