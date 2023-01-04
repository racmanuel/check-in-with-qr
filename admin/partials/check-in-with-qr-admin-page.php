<?php
    global $wpdb; 

    $password = "check-in-with-qr";

    $table_name = $wpdb->prefix . 'check_in_out';
    $results = $wpdb->get_results("SELECT * FROM $table_name");

    /**
     * THIS IS A NOTE FOR DEVELOPMENT:
     * Add a Filters by date and time stamp maybe this is a pro plugin function for the plugin of WordPress.
     * Check in the docs of datatables if this is posible with the SQL DB.
     */
?>
<div class="wrap">
    <h1>Dashboard</h1>
    <div class="container">
        <div class="row">
            <div class="col">
                <table class="table" id="table-checks">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha y Hora</th>
                            <th>ID del Usuario</th>
                            <th>Tipo</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($results as $row) {
                                $user_data = get_userdata( $row->id_user );
                                echo '<tr>';
                                echo '<td>' . $row->id . '</td>';
                                echo '<td>' . $row->time_stamp . '</td>';
                                echo '<td>' . $row->id_user . '</td>';
                                echo '<td>' . $row->check_in. '</td>';
                                //Utilizamos el objeto $user_data con la funcion de get_userdata()
                                echo '<td>' . $user_data->first_name .'</td>';
                                echo '<td>' . $user_data->last_name . '</td>';
                                echo '</tr>';
                            } 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>