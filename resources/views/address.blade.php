<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <script src="https://cdn.tailwindcss.com"></script>
  
  <link href="https://fonts.googleapis.com/css2?family=Battambang:wght@400;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .font-khmer { font-family: 'Battambang', cursive !important; line-height: 1.6; }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

    /* Glass Effect - Monochrome */
    .glass {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
    }
  </style>
  <title>Address System (B&W)</title>
</head>

<body class="bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-gray-100 via-gray-200 to-gray-300 min-h-screen flex items-center justify-center p-3 md:p-6">

  <div id="mainWidget" class="w-full md:max-w-3xl glass rounded-3xl shadow-2xl shadow-gray-900/10 border border-white/50 overflow-hidden transition-all duration-300">
    
    <div class="px-5 py-4 md:px-8 md:py-6 border-b border-gray-200 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white/50">
      <div class="flex items-center gap-3">
        <div class="h-10 w-10 rounded-xl bg-black text-white flex items-center justify-center shadow-md shadow-gray-400/50">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
        </div>
        <div>
          <h1 class="text-lg md:text-xl font-bold text-gray-900 tracking-tight leading-none">Address Setup</h1>
          <p class="text-gray-500 text-[10px] md:text-xs font-semibold uppercase tracking-wider mt-1">Official Location</p>
        </div>
      </div>

      <div class="flex bg-gray-100 p-1 rounded-xl shadow-inner w-full md:w-auto border border-gray-200">
        <button id="langKM" class="flex-1 md:flex-none px-4 py-2 rounded-lg text-xs md:text-sm font-bold text-gray-500 hover:text-black transition-all font-khmer">ខ្មែរ</button>
        <button id="langEN" class="flex-1 md:flex-none px-4 py-2 rounded-lg text-xs md:text-sm font-bold text-gray-500 hover:text-black transition-all">English</button>
      </div>
    </div>

    <div class="p-5 md:p-8">
      
      @if (session('success'))
        <div class="mb-6 p-3 rounded-2xl bg-gray-100 text-gray-800 border border-gray-300 flex items-center gap-3 shadow-sm">
          <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
          <span class="font-bold text-xs md:text-sm">{{ session('success') }}</span>
        </div>
      @endif

      <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('address.submit') }}">
        @csrf
        <input type="hidden" name="lang" id="langInput" value="km">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
          
          <div class="group">
            <label class="block text-[10px] md:text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5 ml-1">Profile Name</label>
            <div class="relative">
              <span class="absolute left-4 top-3.5 text-gray-400 group-focus-within:text-black transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
              </span>
              <input name="user_name" value="{{ old('user_name') }}"
                     class="w-full bg-gray-50 border border-gray-300 text-gray-900 font-semibold text-sm md:text-base rounded-2xl pl-11 pr-4 py-3 md:py-3.5 focus:bg-white focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm placeholder:text-gray-400 placeholder:font-normal"
                     placeholder="Your name" />
            </div>
          </div>

          <div class="relative z-50 group">
            <label class="block text-[10px] md:text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5 ml-1 flex justify-between">
              <span>Quick Search</span>
              <span class="text-black">Village Name</span>
            </label>
            <div class="relative">
              <span class="absolute left-4 top-3.5 text-black">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
              </span>
              <input id="villageSearch" type="text"
                     class="w-full bg-gray-50 border border-gray-300 text-gray-900 font-semibold text-sm md:text-base rounded-2xl pl-11 pr-4 py-3 md:py-3.5 focus:bg-white focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all shadow-sm placeholder:text-gray-400 placeholder:font-normal"
                     placeholder="Search village..." />
            </div>
            <div id="searchBox" class="hidden absolute top-full left-0 right-0 mt-2 bg-white rounded-2xl shadow-xl border border-gray-200 max-h-60 overflow-y-auto no-scrollbar z-50 p-2"></div>
          </div>
        </div>

        <div class="h-px bg-gray-200 w-full"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-5">
          
          <div class="relative">
            <select id="province" name="province_id" 
                    class="appearance-none w-full bg-white border border-gray-300 text-gray-800 text-sm md:text-base font-bold rounded-2xl px-4 py-3 md:px-5 md:py-4 focus:outline-none focus:border-black focus:ring-1 focus:ring-black transition-all cursor-pointer hover:border-gray-400 shadow-sm">
              <option value="">Loading...</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-gray-500">
              <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
          </div>

          <div class="relative">
            <select id="district" name="district_id" disabled
                    class="appearance-none w-full bg-white border border-gray-300 text-gray-800 text-sm md:text-base font-bold rounded-2xl px-4 py-3 md:px-5 md:py-4 focus:outline-none focus:border-black focus:ring-1 focus:ring-black transition-all cursor-pointer disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed shadow-sm">
              <option value="">...</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-gray-500">
              <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
          </div>

          <div class="relative">
            <select id="commune" name="commune_id" disabled
                    class="appearance-none w-full bg-white border border-gray-300 text-gray-800 text-sm md:text-base font-bold rounded-2xl px-4 py-3 md:px-5 md:py-4 focus:outline-none focus:border-black focus:ring-1 focus:ring-black transition-all cursor-pointer disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed shadow-sm">
              <option value="">...</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-gray-500">
              <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
          </div>

          <div class="relative">
            <select id="village" name="village_id" disabled
                    class="appearance-none w-full bg-white border border-gray-300 text-gray-800 text-sm md:text-base font-bold rounded-2xl px-4 py-3 md:px-5 md:py-4 focus:outline-none focus:border-black focus:ring-1 focus:ring-black transition-all cursor-pointer disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed shadow-sm">
              <option value="">...</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-gray-500">
              <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
          </div>
        </div>

        <div class="bg-gray-950 rounded-2xl p-5 md:p-6 text-white shadow-xl flex flex-col md:flex-row justify-between items-center gap-4 mt-2 relative overflow-hidden">
          <div class="absolute top-0 right-0 w-32 h-32 md:w-48 md:h-48 bg-white rounded-full blur-3xl opacity-5 -mr-10 -mt-10 pointer-events-none"></div>
          
          <div class="relative z-10 w-full text-center md:text-left">
             <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Selected Location</div>
             <div id="finalText" class="text-sm md:text-lg font-bold leading-snug text-white min-h-[1.5rem]">—</div>
          </div>
          
          <button id="submitBtn" type="submit" disabled
            class="relative z-10 w-full md:w-auto whitespace-nowrap bg-white text-black rounded-xl px-6 py-3 text-sm md:text-base font-bold shadow-lg hover:bg-gray-100 hover:scale-105 active:scale-95 transition-all disabled:opacity-50 disabled:scale-100 disabled:cursor-not-allowed disabled:bg-gray-800 disabled:text-gray-500 disabled:shadow-none">
            Confirm Location
          </button>
        </div>

      </form>
    </div>
  </div>

<script>
  const API = '/api/address';
  const widget = document.getElementById('mainWidget');
  const provinceEl = document.getElementById('province');
  const districtEl = document.getElementById('district');
  const communeEl  = document.getElementById('commune');
  const villageEl  = document.getElementById('village');
  const finalText  = document.getElementById('finalText');
  const submitBtn  = document.getElementById('submitBtn');
  const villageSearch = document.getElementById('villageSearch');
  const searchBox = document.getElementById('searchBox');
  const langENBtn = document.getElementById('langEN');
  const langKMBtn = document.getElementById('langKM');
  const langInput = document.getElementById('langInput');

  let LANG = 'km';

  function labelFrom(en, km, fallback) {
    if (LANG === 'km') return km || en || fallback;
    return en || km || fallback;
  }

  // Updated for B&W UI
  function updateLangUI() {
    langInput.value = LANG;
    // Active: White bg, Black text, border
    const activeClass = "bg-white text-black shadow-sm ring-1 ring-gray-200 scale-105";
    // Inactive: Gray text
    const inactiveClass = "text-gray-500 hover:text-black";

    langKMBtn.className = "flex-1 md:flex-none px-4 py-2 rounded-lg text-xs md:text-sm font-bold transition-all duration-200 font-khmer ";
    langENBtn.className = "flex-1 md:flex-none px-4 py-2 rounded-lg text-xs md:text-sm font-bold transition-all duration-200 ";

    if (LANG === 'km') {
      langKMBtn.className += activeClass;
      langENBtn.className += inactiveClass;
      widget.classList.add('font-khmer');
      submitBtn.textContent = "រក្សាទុកទីតាំង";
    } else {
      langKMBtn.className += inactiveClass;
      langENBtn.className += activeClass;
      widget.classList.remove('font-khmer');
      submitBtn.textContent = "Confirm Location";
    }
  }

  function setLang(newLang) {
    LANG = newLang;
    updateLangUI();
    refreshSelectedLabels();
    villageSearch.placeholder = (LANG === 'km') ? "ស្វែងរកឈ្មោះភូមិ..." : "Type village name...";
    const defs = (LANG === 'km') ? { p: 'ជ្រើសរើសខេត្ត'} : { p: 'Select Province'};
    if(provinceEl.value === "") provinceEl.options[0].textContent = defs.p;
  }

  function setOptions(select, items, placeholder) {
    select.innerHTML = '';
    const opt0 = document.createElement('option');
    opt0.value = ''; opt0.textContent = placeholder;
    select.appendChild(opt0);
    for (const item of items) {
      const opt = document.createElement('option');
      opt.value = item.id;
      opt.dataset.en = item.name ?? '';
      opt.dataset.km = item.khmer_name ?? '';
      opt.textContent = labelFrom(opt.dataset.en, opt.dataset.km, String(item.id));
      select.appendChild(opt);
    }
  }

  function refreshSelectedLabels() {
    [provinceEl, districtEl, communeEl, villageEl].forEach(sel => {
      for (const opt of sel.options) {
        if (!opt.value) continue;
        opt.textContent = labelFrom(opt.dataset.en || '', opt.dataset.km || '', opt.value);
      }
    });
    updateFinal();
  }

  function resetBelow(level) {
    const ph = (LANG === 'km'); 
    const t_dist = ph ? 'ជ្រើសរើសស្រុក' : 'Select District';
    const t_comm = ph ? 'ជ្រើសរើសឃុំ' : 'Select Commune';
    const t_vill = ph ? 'ជ្រើសរើសភូមិ' : 'Select Village';
    if (level === 'province') {
      districtEl.disabled = true; setOptions(districtEl, [], t_dist);
      communeEl.disabled  = true; setOptions(communeEl,  [], t_comm);
      villageEl.disabled  = true; setOptions(villageEl,  [], t_vill);
    }
    if (level === 'district') {
      communeEl.disabled  = true; setOptions(communeEl, [], t_comm);
      villageEl.disabled  = true; setOptions(villageEl, [], t_vill);
    }
    if (level === 'commune') {
      villageEl.disabled  = true; setOptions(villageEl, [], t_vill);
    }
    updateFinal();
  }

  function updateFinal() {
    const vals = [provinceEl, districtEl, communeEl, villageEl].map(el => el.options[el.selectedIndex]?.textContent || '').filter(t => t && !t.includes('Select') && !t.includes('ជ្រើសរើស'));
    if (provinceEl.value && districtEl.value && communeEl.value && villageEl.value) {
       finalText.innerHTML = vals.join(' <span class="text-gray-500 mx-1">/</span> ');
       finalText.classList.remove('text-gray-500');
    } else {
       finalText.textContent = (LANG === 'km') ? "សូមជ្រើសរើសទីតាំងពេញលេញ" : "Complete selection required";
       finalText.classList.add('text-gray-500');
    }
    submitBtn.disabled = !(provinceEl.value && districtEl.value && communeEl.value && villageEl.value);
  }

  async function fetchJson(url) {
    const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
    if (!res.ok) throw new Error();
    return res.json();
  }

  // Updated for B&W UI
  function showSearch(items) {
    if (!items.length) {
      searchBox.innerHTML = `<div class="p-4 text-xs md:text-sm text-gray-400 text-center italic">No results found</div>`;
      searchBox.classList.remove('hidden');
      return;
    }
    searchBox.innerHTML = items.map(v => {
      const title = labelFrom(v.name ?? '', v.khmer_name ?? '', String(v.id));
      return `
        <button type="button"
          class="w-full text-left px-3 py-2 md:px-4 md:py-3 hover:bg-gray-100 rounded-xl transition-colors group flex items-center justify-between mb-1"
          data-id="${v.id}" data-p="${v.province_id}" data-d="${v.district_id}" data-c="${v.commune_id}">
          <div class="text-xs md:text-sm font-bold text-gray-800 group-hover:text-black">${title}</div>
          <div class="text-[10px] text-gray-400 group-hover:text-gray-600">ID: ${v.id}</div>
        </button>
      `;
    }).join('');
    searchBox.classList.remove('hidden');
  }

  let searchTimer = null;
  villageSearch.addEventListener('input', () => {
    clearTimeout(searchTimer);
    const q = villageSearch.value.trim();
    if (!q) { searchBox.classList.add('hidden'); return; }
    searchTimer = setTimeout(async () => {
      try { const items = await fetchJson(`${API}/search-villages?q=${encodeURIComponent(q)}`); showSearch(items); } catch (e) { console.error(e); }
    }, 300);
  });

  document.addEventListener('click', (e) => {
    if (!searchBox.contains(e.target) && e.target !== villageSearch) searchBox.classList.add('hidden');
  });

  searchBox.addEventListener('click', async (e) => {
    const btn = e.target.closest('button[data-id]');
    if (!btn) return;
    searchBox.classList.add('hidden');
    villageSearch.value = btn.querySelector('.font-bold')?.textContent ?? '';
    await autoFill(btn.dataset.id, btn.dataset.p, btn.dataset.d, btn.dataset.c);
  });

  async function autoFill(vid, pid, did, cid) {
    provinceEl.value = String(pid); provinceEl.dispatchEvent(new Event('change'));
    await waitForEnabled(districtEl);
    districtEl.value = String(did); districtEl.dispatchEvent(new Event('change'));
    await waitForEnabled(communeEl);
    communeEl.value = String(cid); communeEl.dispatchEvent(new Event('change'));
    await waitForEnabled(villageEl);
    villageEl.value = String(vid); villageEl.dispatchEvent(new Event('change'));
  }

  function waitForEnabled(select) {
    return new Promise((resolve) => {
      const check = () => { if (!select.disabled && select.options.length > 1) return resolve(); setTimeout(check, 50); };
      check();
    });
  }

  provinceEl.onchange = async () => {
    resetBelow('province'); if (!provinceEl.value) return;
    const d = await fetchJson(`${API}/districts?province_id=${provinceEl.value}`);
    districtEl.disabled = false; setOptions(districtEl, d, LANG==='km'?'ជ្រើសរើសស្រុក':'Select District');
  };
  districtEl.onchange = async () => {
    resetBelow('district'); if (!districtEl.value) return;
    const c = await fetchJson(`${API}/communes?province_id=${provinceEl.value}&district_id=${districtEl.value}`);
    communeEl.disabled = false; setOptions(communeEl, c, LANG==='km'?'ជ្រើសរើសឃុំ':'Select Commune');
  };
  communeEl.onchange = async () => {
    resetBelow('commune'); if (!communeEl.value) return;
    const v = await fetchJson(`${API}/villages?commune_id=${communeEl.value}`);
    villageEl.disabled = false; setOptions(villageEl, v, LANG==='km'?'ជ្រើសរើសភូមិ':'Select Village');
  };
  villageEl.onchange = updateFinal;

  langKMBtn.onclick = () => setLang('km');
  langENBtn.onclick = () => setLang('en');

  document.addEventListener('DOMContentLoaded', async () => {
    setLang('km'); 
    resetBelow('province');
    await fetchJson(`${API}/provinces`).then(p => setOptions(provinceEl, p, 'ជ្រើសរើសខេត្ត'));
    updateFinal();
  });
</script>

</body>
</html>