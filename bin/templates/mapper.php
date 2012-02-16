<?php
echo "<?php";
?>

/** 
 * This file was generate by Skyseek's StORM System.
 * 
 * The Original Code and all software distributed under the License are
 * distributed on an 'AS IS' basis, WITHOUT WARRANTY OF ANY KIND, EITHER
 * EXPRESS OR IMPLIED, AND APPLE HEREBY DISCLAIMS ALL SUCH WARRANTIES,
 * INCLUDING WITHOUT LIMITATION, ANY WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE, QUIET ENJOYMENT OR NON-INFRINGEMENT.
 * Please see the License for the specific language governing rights and
 * limitations under the License.
 */

<?php if($this->namespace !== null): ?>
namespace <?php echo $this->namespace; ?>;
<?php endif; ?>

require_once 'lib/Mapper.php';

/**
 * <?php echo $this->name; ?> Mapper
 *
 * @author     Skyseek's StORM
 */
class <?php echo $this->name; ?>Mapper extends Mapper 
{
	protected static $_instance;
	protected $_identityMap = array();
	protected $_dataSource = null;

	/**
	 * @return <?php echo $this->name; ?>Mapper
	 */
	public static function getInstance() {
		return parent::getInstance();
	}

	/**
	 * @param DataSource $dataSource
	 * @return DataSource
	 *
	public function dataSource(DataSource $dataSource)
	{
		
	}
}