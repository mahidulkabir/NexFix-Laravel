<x-portal.header/>

<body>
    <x-userDashboard.navbar/> 

   

<main>
    {{ $slot  }}
</main>
    
  <x-portal.footer />

</body>

</html>
