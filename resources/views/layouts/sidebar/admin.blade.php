<li>
    <a href="/mentor" @if(request()->segment(1) == 'mentor') class="active" @endif>
        <i class="mdi mdi-account"></i>
        <span> Pembimbing </span>
    </a>
</li>
<li>
    <a href="/company" @if(request()->segment(1) == 'company') class="active" @endif>
        <i class="mdi mdi-office-building"></i>
        <span> Perusahaan </span>
    </a>
</li>
<li>
    <a href="/student" @if(request()->segment(1) == 'student') class="active" @endif>
        <i class="mdi mdi-account-outline"></i>
        <span> Murid </span>
    </a>
</li>
<li>
    <a href="/setting" @if(request()->segment(1) == 'setting') class="active" @endif>
        <i class="mdi mdi-cog-outline"></i>
        <span> Pengaturan </span>
    </a>
</li>