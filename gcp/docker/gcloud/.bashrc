# The next line updates PATH for the Google Cloud SDK.
if [ -f '/usr/src/gcp/google-cloud-sdk/path.bash.inc' ]; then . '/usr/src/gcp/google-cloud-sdk/path.bash.inc'; fi

# The next line enables shell command completion for gcloud.
if [ -f '/usr/src/gcp/google-cloud-sdk/completion.bash.inc' ]; then . '/usr/src/gcp/google-cloud-sdk/completion.bash.inc'; fi

alias cloud_sql_proxy=/usr/src/gcp/cloud_sql_proxy