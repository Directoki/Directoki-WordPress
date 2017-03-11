    # -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|

  config.vm.synced_folder ".", "/vagrant/wp-content/plugins/directoki",  :owner=> 'www-data', :group=>'users'

  config.vm.define "normal" do |normal|

    normal.vm.network "forwarded_port", guest: 80, host: 8080

    normal.vm.box = "boxcutter/debian8"

    normal.vm.provider "virtualbox" do |vb|
      vb.gui = false
      vb.memory = "512"
      # https://github.com/boxcutter/ubuntu/issues/82#issuecomment-260902424
      vb.customize [
              "modifyvm", :id,
              "--cableconnected1", "on",
          ]
    end

    normal.vm.provision :shell, path: "vagrant/bootstrap.sh"

  end



end
