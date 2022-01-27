<?php get_header('Mierzenie czasu', ['timer.css']); ?>
<div class="container">
    <h1 class="timer-title">Timer</h1>
    <div class="timer">
        <h3 class="timer-text"></h3>
        <input type="hidden" id="current_project" value="<?php echo isset($data['project_in_progress']['project_date']) ? strtotime($data['project_in_progress']['start_date']) * 1000 : 0; ?>" />
        <input type="hidden" id="current_project_id" value="<?php echo isset($data['project_in_progress']['projectId']) ? $data['project_in_progress']['start_date'] : 0; ?>" />
        <input type="hidden" id="project_name" value="<?php echo isset($data['project_in_progress']['project_name']) ?? $data['project_in_progress']['project_name'] : 0; ?>" />
    </div>
    <input name="task_name" id="project_name_input" type="text" placeholder="Wprowadź nazwę projektu"/>
    <button counting="0" class="timer-button">Start</button>
    <div class="timer_history">
        <?php foreach ($data['archived_projects'] as $archived_project) {
            $interval = date_diff(date_create($archived_project['start_date']), date_create($archived_project['end_date']));
            $date = new DateTime($archived_project['start_date']);
        ?>
            <div class="timer_history_entry">
                <p class="timer_entry_title"><?php echo $archived_project['project_name']; ?></p>
                <p><?php echo $date->format('Y-m-d'); ?></p>
                <p><?php echo $interval->format('%H:%I:%S'); ?></p>
                <a href="/edit?id=<?php echo $archived_project["id"]?>">Edycja</a>
                <a href="/delete?id=<?php echo $archived_project["id"]?>" style="color:#E86548">X</a>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<?php get_footer(['timer.js']); ?>