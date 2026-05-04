<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-success">
            <h5>Data Kelas</h5>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kelas</th>
                        <th>Jumlah Siswa</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no=1;
                    $kelas = ["X RPL", "XI RPL", "XII RPL"];

                    foreach($kelas as $k){
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $k ?></td>
                        <td><?= rand(20,35) ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>