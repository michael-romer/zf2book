<?php
namespace Helloworld\Service;

class LoggingService implements LoggingServiceInterface
{
	public function onGetGreeting()
	{
		$this->log('getGreeting executed!');
	}

    public function log($str)
    {
        /* Discard log for demo purposes */
        return;

        /* Remove the "return" above for db access demos */
        $adapter = new \Zend\Db\Adapter\Adapter(
       		array(
       			'driver' => 'Pdo_Mysql',
       			'database' => 'app',
       			'username' => 'root',
       			'password' => ''
       		)
       	);

        /* Writing host entry to database */
        $sql = new \Zend\Db\Sql\Sql($adapter);
        $insert = $sql->insert('host');
        $insert->columns(array('ip', 'hostname'));

        $insert->values(array(
            'ip' => '192.168.1.15',
            'hostname' => 'michaels-ipad')
        );

        $statement = $sql->prepareStatementForSqlObject($insert);
        $results = $statement->execute();

        /* Updating host entry in database */
        $sql = new \Zend\Db\Sql\Sql($adapter);
        $update = $sql->update('host');
        $update->set(array('ip' => '192.168.1.20'));
        $update->where('hostname = "michaels-ipad"');
        $statement = $sql->prepareStatementForSqlObject($update);
        $results = $statement->execute();

        /* Reading hosts from database using TableGateway with RowGatewayFeature and Entity class */
        $hostTable = new \Zend\Db\TableGateway\TableGateway(
    		'host',
    		$adapter,
    		new \Zend\Db\TableGateway\Feature\RowGatewayFeature('id')
        );

        $results = $hostTable->select(array('hostname' => 'michaels-ipad'));

        $hosts = new \Zend\Db\ResultSet\HydratingResultSet(
       		new \Helloworld\Mapper\HostHydrator(),
       		new \Helloworld\Entity\Host()
       	);

        $hosts->initialize($results->toArray());

        /* Remove entry from database */
        $sql = new \Zend\Db\Sql\Sql($adapter);
        $delete = $sql->delete('');
        $delete->from('host');
        $delete->where('hostname = "michaels-ipad"');
        $statement = $sql->prepareStatementForSqlObject($delete);
        $results = $statement->execute();

        /* Reading all log entries from database */
        $stmt = $adapter->createStatement('SELECT * FROM log');
        $logs = $stmt->execute();

        /* Alternative way to do "SELECT * FROM log"
        $sql = new \Zend\Db\Sql\Sql($adapter);
        $select = $sql->select();
        $select->from('log');
        $statement = $sql->prepareStatementForSqlObject($select);
    	$logs = $statement->execute();
        */
    }
}