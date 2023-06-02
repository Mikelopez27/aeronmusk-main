
<x-app-layout>
   <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1 pb-16">
              <div class="bg-white shadow-md rounded my-6 p-5">
                <form method="POST" action="{{ route('admin.marcas.store') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="flex flex-col space-y-2">
                    <label for="title" class="text-gray-700 select-none font-medium">Nivel Educativo</label>
                    <input id="title" type="text" name="name" value="{{ old('name') }}" required
                      placeholder="Escribe el nivel educativo" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="title" class="text-gray-700 select-none font-medium">Descripcion del nivel</label>
                    <input id="title" type="text" name="description" value="{{ old('description') }}" required
                      placeholder="Escribe la descripcion" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    />
                </div>
               
               
        
               
               
                <div class="text-center mt-16 mb-16">
                  <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Crear Nivel educativo</button>
                </div>
              </div>

              <!-- @if(Session::has('message'))
<script >

    swal("Message","{{Session::get('message')}}",'success',{
      button:true,
      button:"OK",
      timer:3000
    })
 
  </script>
  @endif -->
  @if (Session::has('message'))
    <script>
        var message = @json(Session::get('message'));
        swal({
            title: message.txtp,
            text: message.text,
            icon: message.icon,
            button: {
                text: "Aceptar",
                closeModal: false,
            },
        }).then(function() {
            window.location.href = message.route;
        });
    </script>
@endif
            </div>
        </main>
    </div>
</div>

</x-app-layout>

