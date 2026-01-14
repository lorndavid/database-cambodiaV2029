<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <script src="https://cdn.tailwindcss.com"></script>
  
  <link href="https://fonts.googleapis.com/css2?family=Battambang:wght@400;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .font-khmer { font-family: 'Battambang', cursive !important; }
    
    /* Glass Effect */
    .glass {
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
    }
    
    /* Custom Scrollbar for Table */
    .custom-scroll::-webkit-scrollbar { height: 6px; width: 6px; }
    .custom-scroll::-webkit-scrollbar-track { background: transparent; }
    .custom-scroll::-webkit-scrollbar-thumb { background-color: #e5e7eb; border-radius: 10px; }
    .custom-scroll::-webkit-scrollbar-thumb:hover { background-color: #9ca3af; }
  </style>
  <title>Admin Dashboard</title>
</head>

<body class="bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-gray-100 via-gray-200 to-gray-300 min-h-screen p-4 md:p-8">

  <div class="max-w-7xl mx-auto">
    
    <div class="glass rounded-[2rem] shadow-2xl shadow-gray-900/5 border border-white/60 overflow-hidden">
      
      <div class="p-6 md:p-8 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-4">
          <div class="h-12 w-12 rounded-2xl bg-black text-white flex items-center justify-center shadow-lg shadow-gray-400/50">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
          </div>
          <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Submissions</h1>
            <p class="text-gray-500 text-sm font-medium mt-0.5">Manage user address entries</p>
          </div>
        </div>

        <a href="/admin/submissions/export"
           class="group flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-black text-white font-bold text-sm shadow-md hover:bg-gray-800 transition-all active:scale-95">
           <svg class="w-4 h-4 text-gray-300 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
           Export CSV
        </a>
      </div>

      <div class="px-6 md:px-8 py-6 bg-gray-50/50">
        <form class="relative flex w-full md:max-w-2xl gap-2" method="GET" action="/admin/submissions">
          <div class="relative w-full">
            <span class="absolute left-4 top-3.5 text-gray-400">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </span>
            <input name="q" value="{{ $q }}"
              class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 bg-white font-medium text-gray-800 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-black/5 focus:border-black transition-all shadow-sm text-sm"
              placeholder="Search by Name, Province, District..." />
          </div>
          <button class="px-6 py-3 rounded-xl bg-white border border-gray-200 font-bold text-gray-900 hover:bg-gray-50 hover:border-gray-300 transition-all text-sm shadow-sm">
            Search
          </button>
        </form>
      </div>

      <div class="overflow-x-auto custom-scroll">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-gray-100/80 border-y border-gray-200 text-xs uppercase tracking-wider text-gray-500 font-bold">
              <th class="px-6 py-4 whitespace-nowrap">ID</th>
              <th class="px-6 py-4 whitespace-nowrap">User Name</th>
              <th class="px-6 py-4 whitespace-nowrap">Language</th>
              <th class="px-6 py-4 whitespace-nowrap">Province</th>
              <th class="px-6 py-4 whitespace-nowrap">District</th>
              <th class="px-6 py-4 whitespace-nowrap">Commune</th>
              <th class="px-6 py-4 whitespace-nowrap">Village</th>
              <th class="px-6 py-4 whitespace-nowrap text-right">Date</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-100">
            @forelse ($items as $r)
              <tr class="group hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 text-xs font-mono text-gray-400">#{{ $r->id }}</td>
                
                <td class="px-6 py-4">
                  <div class="font-bold text-gray-900 font-khmer">{{ $r->user_name }}</div>
                </td>
                
                <td class="px-6 py-4">
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wide
                    {{ $r->lang == 'km' ? 'bg-black text-white' : 'bg-gray-200 text-gray-600' }}">
                    {{ $r->lang }}
                  </span>
                </td>

                <td class="px-6 py-4 text-sm font-medium text-gray-700 font-khmer">{{ $r->province_name }}</td>
                <td class="px-6 py-4 text-sm text-gray-500 font-khmer">{{ $r->district_name }}</td>
                <td class="px-6 py-4 text-sm text-gray-500 font-khmer">{{ $r->commune_name }}</td>
                <td class="px-6 py-4 text-sm text-gray-500 font-khmer">{{ $r->village_name }}</td>
                
                <td class="px-6 py-4 text-sm text-gray-400 text-right whitespace-nowrap">
                  {{ $r->created_at->format('M d, Y') }}
                  <span class="block text-[10px]">{{ $r->created_at->format('h:i A') }}</span>
                </td>
              </tr>
            @empty
              <tr>
                <td class="px-6 py-12 text-center text-gray-400" colspan="8">
                  <div class="flex flex-col items-center justify-center gap-2">
                    <svg class="w-8 h-8 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>No submissions found</span>
                  </div>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="px-6 md:px-8 py-6 border-t border-gray-100 bg-gray-50/50">
        {{ $items->links() }}
      </div>

    </div>
    
    <div class="text-center mt-6 text-gray-400 text-xs font-medium uppercase tracking-widest opacity-60">
      Admin Panel &bull; v2.0
    </div>

  </div>
</body>
</html>