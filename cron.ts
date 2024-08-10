import cron from 'node-cron';
import shell from 'shelljs';

cron.schedule('* * * * *', () => {
    console.log('running a task every minute');
    shell.exec('php artisan schedule:run');
});

// 0 22 * * 1-5