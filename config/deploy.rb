set :application, "st-wiki"
set :repository,  "git@transit-dev.admin.umass.edu:/st-wiki/st-wiki.git"

set :scm, :git

role :web, "transit-app1.admin.umass.edu"
role :app, "transit-app1.admin.umass.edu"

set :deploy_to, "/srv/#{application}"
set :deploy_via, :export

set :server_user, "apache"
set :server_group, "wheel"

set :ssh_options, { :forward_agent => true, :port => 1022 }
default_run_options[:pty] = true

set :shared_children, ["images"]

after "deploy:setup", "deploy:permissions"

namespace :deploy do
  desc <<-DESC
    Fixes directory permissions - run after setup.  This task trys to set \
    ownership of the deploy path to server_user:server_group and then sets \
    the permissions to at least rw-r-S---.

    If group_writable is set, add that.
  DESC
  task :permissions do
    run "#{try_sudo} chown -R #{server_user}:#{server_group} #{deploy_to} && #{try_sudo} chmod -R g+s #{deploy_to}"
    run "#{try_sudo} chmod -R g+w #{deploy_to}" if fetch(:group_writable, true)
  end

  #Borrowed from capistrano/capistrano:HEAD  Not yet in the gem version.
  desc <<-DESC
    [internal] Touches up the released code. This is called by update_code \
    after the basic deploy finishes.

    This task will make the release group-writable (if the :group_writable \
    variable is set to true, which is the default). It will then set up \
    symlinks to the shared directory for the :shared_children \
    directories.
  DESC
  task :finalize_update, :except => { :no_release => true } do
    run "chmod -R g+w #{latest_release}" if fetch(:group_writable, true)

    # mkdir -p is making sure that the directories are there for some SCM's that don't
    # save empty folders
    shared_children.map do |d|
      if (d.rindex('/')) then
        run "rm -rf #{latest_release}/#{d} && mkdir -p #{latest_release}/#{d.slice(0..(d.rindex('/')))}"
      else
        run "rm -rf #{latest_release}/#{d}"
      end
      run "ln -s #{shared_path}/#{d.split('/').last} #{latest_release}/#{d}"
    end
  end
end
