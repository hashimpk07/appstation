# Appstation Pvt Ltd.
<ul>
    <li>Project Created By  : HASHIM PK  </li>
    <li>Project Created 0n  : 19/06/2025 to 19/06/2025 </li>
    <li>Using Technology    : Laravel 10.48.16 , Mysq  </li>
</ul>


<h2 style="font-weight: bold";>About Application</h2>
 <h4>PHP Machine Test : PHP Laravel Machine Test: API Rate Limiting &amp;
Monetization Platform . </h4> <p>You are tasked with building the backend of a platform that offers public APIs to third-
party developers. Each registered developer gets access to a set of APIs, but their
usage is limited based on their subscription tier (free, standard, premium). The system
should enforce rate limits on API usage, monitor usage metrics, and reset limits
periodically. Additionally, premium users should be billed monthly based on usage.
The system should demonstrate robust control over rate-limiting, background task
handling for resets and billing, and modular, well-documented Laravel code.</p>

<h4>User Authentication</h4>
<ul> 
<li>Use Laravel Sanctum or Passport for API token-based authentication.</li>
<li>Each user should receive an API key/token upon registration.</li>
<li>Subscription Tiers</li>
<li>API Access Control.</li>
<li>Usage Tracking &amp; Reporting</li>
<li>Billing (for Premium Users)</li>
<li>Reset Quotas</li>
</ul>
<h4>Rate-Limiting Approach</h4>
<ul>
  <li>Implemented using a custom middleware: CheckApiQuota.</li>
  <li>When a user accesses a protected API endpoint (/api/data), the middleware
    <ul>
      <li>Checks their subscription tier (Free, Standard, Premium). </li>
      <li>Retrieves or creates a daily usage record in the api_usages table</li>
      <li>Retrieves or creates a daily usage record in the api_usages table</li>
      <li>If usage exceeds the tier limit (e.g., 100/day for Free), returns 429 Too Many Requests.</li>
      <li>Otherwise, increments usage count and logs the API call in api_logs.</li>
    </ul>
  </li>
</ul>
<h4>Features</h4>
<ul>
  <li>Laravel Sanctum authentication.</li>
  <li>Tier-based rate limiting (Free, Standard, Premium)</li>
  <li>Daily API quota enforcement</li>
  <li> Monthly billing for Premium users</li>
  <li> Background jobs with Laravel Queue</li>
  <li>Scheduler for quota reset & billing </li>
</ul>

<h4>Technologies</h4>
<ul>
  <li>Laravel 10.4.8 Version.</li>
  <li>Sanctum </li>
  <li>Mysql</li>
  <li> Laravel Queue (Mysql DB ) </li>
  <li> Laravel Scheduler </li>
</ul>

<h2 style="font-weight: bold;">How to Execute the Project</h2>
<ul>
    <li><strong>Step 1:</strong> Clone the project:<br><code>git clone https://github.com/hashimpk07/twoHatslogic.git</code></li>
    <li><strong>Step 2:</strong> Create a <code>.env</code> file from <code>.env.example</code>:</li>
    <li><strong>Step 3:</strong> Update the <code>.env</code> file with the following DB settings:<br>
        <code>
            DB_CONNECTION=mysql<br>
            DB_HOST=127.0.0.1<br>
            DB_PORT=3306<br>
            DB_DATABASE=2hats<br>
            DB_USERNAME=root<br>
            DB_PASSWORD=
        </code>
    </li>
    <li><strong>Step 4:</strong> Install project dependencies:<br><code>composer install</code> or <code>composer update</code></li>
    <li><strong>Step 5:</strong> Ensure the <code>vendor/</code> folder is created successfully.</li>
    <li><strong>Step 6:</strong> Make sure the database <code>appstation</code> exists in your DB server.</li>
    <li><strong>Step 7:</strong> Run migration to create tables:<br><code>php artisan migrate</code></li>
    <li><strong>Step 8:</strong> Run seeders to populate initial data:<br><code>php artisan db:seed --class=SubscriptionTierSeeder</code></li>
    <li><strong>Step 9:</strong> Generate Sanctum keys:<br><code>php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"</code></li>
    <li><strong>Step 10:</strong> Start the application:<br><code>php artisan serve</code></li>
    <li><strong>Step 11:</strong> Create the queue table:<br><code>php artisan queue:table && php artisan migrate</code></li>
    <li><strong>Step 12:</strong> Start queue worker in a separate terminal:<br><code>php artisan queue:work</code></li>
    <li><strong>Step 13:</strong> Run the scheduler manually (or use cron):<br><code>php artisan schedule:run</code></li>
    <li><strong>Step 14:</strong> Open the served URL in your browser (usually http://127.0.0.1:8000).</li>
</ul>
   
