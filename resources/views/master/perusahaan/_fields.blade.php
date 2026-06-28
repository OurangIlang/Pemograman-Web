{{-- Shared editable fields for perusahaan create/edit. $item may be null on create. --}}
<div class="form-element">
  <label>Nama Perusahaan</label>
  <input type="text" name="nama_perusahaan" class="form-control @error('nama_perusahaan') is-invalid @enderror" value="{{ old('nama_perusahaan', $item->nama_perusahaan ?? '') }}" required>
  @error('nama_perusahaan') <span class="invalid-feedback">{{ $message }}</span> @enderror
</div>
<div class="form-element">
  <label>Alamat</label>
  <textarea name="alamat_perusahaan" class="form-control @error('alamat_perusahaan') is-invalid @enderror" rows="2">{{ old('alamat_perusahaan', $item->alamat_perusahaan ?? '') }}</textarea>
  @error('alamat_perusahaan') <span class="invalid-feedback">{{ $message }}</span> @enderror
</div>
<div class="form-element">
  <label>No. Telpon</label>
  <input type="text" name="no_telpon" class="form-control @error('no_telpon') is-invalid @enderror" value="{{ old('no_telpon', $item->no_telpon ?? '') }}">
  @error('no_telpon') <span class="invalid-feedback">{{ $message }}</span> @enderror
</div>
<div class="form-element">
  <label>No. Fax</label>
  <input type="text" name="no_fax" class="form-control @error('no_fax') is-invalid @enderror" value="{{ old('no_fax', $item->no_fax ?? '') }}">
  @error('no_fax') <span class="invalid-feedback">{{ $message }}</span> @enderror
</div>
<div class="form-element">
  <label>Email</label>
  <input type="email" name="email_perusahaan" class="form-control @error('email_perusahaan') is-invalid @enderror" value="{{ old('email_perusahaan', $item->email_perusahaan ?? '') }}">
  @error('email_perusahaan') <span class="invalid-feedback">{{ $message }}</span> @enderror
</div>
<div class="form-element">
  <label>Nama Petugas</label>
  <input type="text" name="nama_petugas" class="form-control @error('nama_petugas') is-invalid @enderror" value="{{ old('nama_petugas', $item->nama_petugas ?? '') }}">
  @error('nama_petugas') <span class="invalid-feedback">{{ $message }}</span> @enderror
</div>
<div class="form-element">
  <label>Nama Penandatangan</label>
  <input type="text" name="nama_penandatangan" class="form-control @error('nama_penandatangan') is-invalid @enderror" value="{{ old('nama_penandatangan', $item->nama_penandatangan ?? '') }}">
  @error('nama_penandatangan') <span class="invalid-feedback">{{ $message }}</span> @enderror
</div>
<div class="form-element">
  <label>Jabatan</label>
  <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan', $item->jabatan ?? '') }}">
  @error('jabatan') <span class="invalid-feedback">{{ $message }}</span> @enderror
</div>
