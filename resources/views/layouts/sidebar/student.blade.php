<li>
    <a href="/schedule" @if(request()->segment(1) == 'student') class="active" @endif>
        <i class="mdi mdi-calendar-check"></i>
        <span> Jadwal</span>
    </a>
    <a href="/history" @if(request()->segment(1) == 'student') class="active" @endif>
        <i class="mdi mdi-calendar"></i>
        <span> Riwayat</span>
    </a>
</li>