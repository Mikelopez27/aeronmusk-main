<x-app-layout>
  <div>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
      <div class="container mx-auto px-6 py-1 pb-16">
        <div class="bg-white shadow-md rounded my-6 p-5">
          <form method="POST" action="{{ route('admin.groups.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col space-y-2">
            <label for="grade" class="text-gray-700 select-none font-medium">Selecciona el Grado</label>
              <select name="grades[]">
                @foreach($grades as $grade)
                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                @endforeach
              </select>
            </div>
            <br>
            <div class="flex flex-col space-y-2">
            <label for="section" class="text-gray-700 select-none font-medium">Selecciona la Seccion</label>
              <select name="sections[]">
                @foreach($sections as $section)
                <option value="{{ $section->id }}">{{ $section->name }}</option>
                @endforeach
              </select>
            </div>


            <div class="text-center mt-16 mb-16">
              <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Crear Grupo</button>
            </div>
        </div>

        @if(Session::has('message'))
        <script>
          swal("Message", "{{Session::get('message')}}", 'success', {
            button: true,
            button: "OK",
            timer: 3000
          })
        </script>
        @endif
      </div>
    </main>
  </div>
  </div>

</x-app-layout>